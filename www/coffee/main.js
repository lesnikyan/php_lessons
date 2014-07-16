// Generated by CoffeeScript 1.7.1
(function() {
  var Ejector, Particle, SecondParticle, ThirdParticle, Unit, UserInterface, Vec2, World, animationLoop, dist, log, square,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  log = function(x) {
    if (console) {
      return console.log(x);
    }
  };

  animationLoop = function(foo) {
    return requestAnimationFrame(foo);
  };

  Vec2 = (function() {
    function Vec2(x, y) {
      this.x = x != null ? x : 0;
      this.y = y != null ? y : 0;
    }

    Vec2.prototype.set = function(x, y) {
      this.x = x;
      return this.y = y;
    };

    Vec2.prototype.add = function(other) {
      this.x += other.x;
      this.y += other.y;
      return this;
    };

    Vec2.prototype.mult = function(val) {
      var x, y, _ref;
      _ref = val instanceof Vec2 ? [val.x, val.y] : [val, val], x = _ref[0], y = _ref[1];
      this.x *= x;
      this.y *= y;
      return this;
    };

    Vec2.prototype.part = function(val) {
      var x, y, _ref;
      _ref = val instanceof Vec2 ? [val.x, val.y] : [val, val], x = _ref[0], y = _ref[1];
      return new Vec2(this.x * x, this.y * x);
    };

    Vec2.prototype.copy = function() {
      return new Vec2(this.x, this.y);
    };

    Vec2.prototype.toArray = function() {
      return [this.x, this.y];
    };

    Vec2.random = function(min, max) {
      var floatRand, _ref;
      if (min instanceof Vec2) {
        _ref = [min.x, min.y], min = _ref[0], max = _ref[1];
      }
      if (min == null) {
        min = 0;
      }
      if (max == null) {
        max = 1;
      }
      floatRand = function(a, b) {
        return Math.random() * (max - min) + min;
      };
      return new Vec2(floatRand(min, max), floatRand(min, max));
    };

    return Vec2;

  })();

  World = (function() {
    function World(canvas) {
      this.canvas = canvas;
      this.ctx = this.canvas.getContext('2d');
      this.width = this.canvas.width;
      this.height = this.canvas.height;
      this.units = [];
      this.active = false;
      this.fokus = new Vec2(this.width / 2, this.height / 2);
      this.pushField = 100;
      this["interface"] = new UserInterface(this);
    }

    World.prototype.tick = function() {
      var curTime;
      if (!this.active) {
        return;
      }
      curTime = Date.now();
      this.curDiff = curTime - this.lastTime;
      this.update();
      this.draw();
      this.lastTime = curTime;
      return animationLoop(this.tick.bind(this));
    };

    World.prototype.start = function() {
      this.active = true;
      this.lastTime = Date.now();
      log(this.lastTime);
      return this.tick();
    };

    World.prototype.stop = function() {
      return this.active = false;
    };

    World.prototype.toggle = function() {
      log("toggle: " + (this.active ? 'stop' : 'start'));
      if (this.active) {
        return this.stop();
      } else {
        return this.start();
      }
    };

    World.prototype.update = function() {
      var unit, _i, _len, _ref, _results;
      _ref = this.units;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        unit = _ref[_i];
        _results.push(unit.update(this.curDiff));
      }
      return _results;
    };

    World.prototype.draw = function() {
      var unit, _i, _len, _ref, _results;
      this.ctx.clearRect(0, 0, this.width, this.height);
      this.ctx.fillStyle = '#444';
      this.ctx.fillRect(0, 0, this.width, this.height);
      _ref = this.units;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        unit = _ref[_i];
        _results.push(unit.draw());
      }
      return _results;
    };

    World.prototype.addUnit = function(unit) {
      return this.units.push(unit);
    };

    World.prototype.moveFokus = function(e) {
      return this.fokus.set(e.offsetX, e.offsetY);
    };

    World.prototype.mouseClick = function(e) {
      return this.toggle();
    };

    return World;

  })();

  Unit = (function() {
    function Unit() {
      this.id = Unit.nextId();
    }

    Unit.nextId = function() {
      return this.lastId++;
    };

    Unit.lastId = 1;

    return Unit;

  })();

  Ejector = (function(_super) {
    __extends(Ejector, _super);

    function Ejector(params) {
      Ejector.__super__.constructor.apply(this, arguments);
      this.world = params.world;
      this.pos = params.pos;
      this.parts = [];
      this.maxParticles = 300;
      this.addNum = 2;
      this.life = 2;
    }

    Ejector.prototype.update = function(time) {
      var index, part, _i, _ref;
      _ref = this.parts;
      for (index = _i = _ref.length - 1; _i >= 0; index = _i += -1) {
        part = _ref[index];
        part.update(time);
        if (part.ended) {
          this.remove(index);
        }
      }
      if (this.parts.length < this.maxParticles - this.addNum) {
        return this.add();
      }
    };

    Ejector.prototype.remove = function(index) {
      if (this.parts[index].type === 'Part1') {
        this.addSecond(this.parts[index]);
      }
      return this.parts.splice(index, 1);
    };

    Ejector.prototype.draw = function() {
      var index, part, _i, _len, _ref, _results;
      this.drawShape();
      _ref = this.parts;
      _results = [];
      for (index = _i = 0, _len = _ref.length; _i < _len; index = ++_i) {
        part = _ref[index];
        _results.push(part.draw());
      }
      return _results;
    };

    Ejector.prototype.drawShape = function() {
      var ctx;
      ctx = this.world.ctx;
      ctx.strokeStyle = '#888';
      ctx.beginPath();
      ctx.arc(this.pos.x, this.pos.y, 15, 0, 2 * Math.PI);
      ctx.closePath();
      return ctx.stroke();
    };

    Ejector.prototype.add = function() {
      var num, _i, _ref, _results;
      _results = [];
      for (num = _i = 1, _ref = this.addNum; 1 <= _ref ? _i <= _ref : _i >= _ref; num = 1 <= _ref ? ++_i : --_i) {
        _results.push(this.addPart());
      }
      return _results;
    };

    Ejector.prototype.addPart = function() {
      var params;
      params = {
        world: this.world,
        pos: this.pos.copy(),
        life: this.life
      };
      return this.addUnit(new Particle(params));
    };

    Ejector.prototype.addSecond = function(part) {
      return this.addUnit(new SecondParticle(part));
    };

    Ejector.prototype.addUnit = function(unit) {
      return this.parts.push(unit);
    };

    return Ejector;

  })(Unit);

  Particle = (function(_super) {
    __extends(Particle, _super);

    function Particle(params) {
      var _ref;
      Particle.__super__.constructor.apply(this, arguments);
      this.type = 'Part1';
      this.world = params.world;
      this.pos = params.pos;
      this.life = (_ref = params.life) != null ? _ref : 2;
      this.step = 100;
      this.gravity = new Vec2(0, -2);
      this.size = 5;
      this.ended = false;
      this.direction = new Vec2(this.gravity.x + this.gravity.y / 20 - Math.random() * this.gravity.y / 10, this.gravity.y / 2 * Math.random() + this.gravity.y / 2);
      this.stepDir = this.direction.copy().mult(this.step);
    }

    Particle.prototype.update = function(time) {
      var fokusDist, pureStep, subTime, vectDist;
      if (this.ended) {
        return;
      }
      subTime = time / 1000;
      this.life -= subTime;
      if (this.life < 0) {
        this.ended = true;
      }
      pureStep = this.stepDir.part(subTime);
      fokusDist = dist(this.world.fokus, this.pos) / 100;
      vectDist = new Vec2(this.pos.x - this.world.fokus.x, this.pos.y - this.world.fokus.y).mult(1 / 10000).mult(this.world.pushField / (square(fokusDist)));
      pureStep.add(vectDist);
      return this.pos.add(pureStep);
    };

    Particle.prototype.draw = function() {
      var ctx;
      if (this.ended) {
        return;
      }
      ctx = this.world.ctx;
      ctx.fillStyle = '#ff2200';
      ctx.beginPath();
      ctx.arc(this.pos.x, this.pos.y, this.size, 0, 2 * Math.PI);
      ctx.closePath();
      return ctx.fill();
    };

    return Particle;

  })(Unit);

  square = function(x) {
    return x * x;
  };

  dist = function(a, b) {
    return Math.sqrt(square(b.x - a.x) + square(b.y - a.y));
  };

  SecondParticle = (function(_super) {
    __extends(SecondParticle, _super);

    function SecondParticle(params) {
      SecondParticle.__super__.constructor.call(this, params);
      this.type = 'Part2';
      this.size = 10;
      this.maxLife = this.life = .3;
      this.ended = false;
      this.direction = params.direction;
      this.stepDir = this.direction.copy().mult(this.step);
    }

    SecondParticle.prototype.draw = function() {
      var ctx;
      if (this.ended) {
        return;
      }
      ctx = this.world.ctx;
      ctx.strokeStyle = '#eee';
      ctx.beginPath();
      ctx.arc(this.pos.x, this.pos.y, this.size * (this.life / this.maxLife / 2 + this.maxLife / 2), 0, 2 * Math.PI);
      ctx.closePath();
      return ctx.stroke();
    };

    return SecondParticle;

  })(Particle);

  ThirdParticle = (function(_super) {
    __extends(ThirdParticle, _super);

    function ThirdParticle(params) {
      ThirdParticle.__super__.constructor.call(this, params);
      this.step = 30;
      this.direction.x *= 2;
      this.stepDir = this.direction.copy().mult(this.step);
    }

    ThirdParticle.prototype.draw = function() {
      var ctx;
      if (this.ended) {
        return;
      }
      ctx = this.world.ctx;
      ctx.fillStyle = '#111';
      ctx.beginPath();
      ctx.arc(this.pos.x, this.pos.y, this.size, 0, 2 * Math.PI);
      ctx.closePath();
      return ctx.fill();
    };

    return ThirdParticle;

  })(SecondParticle);

  UserInterface = (function() {
    function UserInterface(world) {
      this.world = world;
      $(document).click((function(_this) {
        return function(e) {
          return _this.world.mouseClick(e);
        };
      })(this));
      $(this.world.canvas).mousemove((function(_this) {
        return function(e) {
          return _this.world.moveFokus(e);
        };
      })(this));
    }

    return UserInterface;

  })();

  $(window).load(function() {
    var world;
    world = new World(document.getElementById('display'));
    world.addUnit(new Ejector({
      world: world,
      pos: new Vec2(200, 550)
    }));
    world.addUnit(new Ejector({
      world: world,
      pos: new Vec2(400, 550)
    }));
    world.addUnit(new Ejector({
      world: world,
      pos: new Vec2(600, 550)
    }));
    return world.start();
  });

}).call(this);
