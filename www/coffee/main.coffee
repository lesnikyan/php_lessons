# cd path/of/project
# coffee -w -0 ./ *.coffee

###
online 2 3
http://jsbin.com/kabozihe/1
###

log = (x) -> console.log(x) if console

test2 = (x) -> x * x * 21

animationLoop = (foo) ->
	requestAnimationFrame foo

# VECTOR 2D

class Vec2
	constructor:(x, y)->
		@x = x ? 0
		@y = y ? 0

	set:(x, y)->
		@x = x
		@y = y

	add: (other) ->
		@x += other.x
		@y += other.y
		return @

	mult:(val)->
		[x,y] = if val instanceof Vec2 then [val.x, val.y] else [val, val]
		@x *= x
		@y *= y
		return @

	part:(val)->
		[x,y] = if val instanceof Vec2 then [val.x, val.y] else [val, val]
		return new Vec2 @x * x, @y * x

	copy:->
		new Vec2 @x, @y

	dist:(point)->
		new Vec2 (point.x - @x ), (point.y - @y )

	scalar:->
		Math.sqrt (@x * @x + @y * @y)

	toArray:->
		[@x, @y]

	@random: (min, max)->
		[min, max] = [min.x, min.y] if min instanceof Vec2
		min ?= 0
		max ?= 1
		floatRand = (a, b) ->
			do Math.random  * (max - min) + min
		new Vec2 floatRand(min, max), floatRand(min, max)


# WORLD CLASS
class World
	constructor: (@canvas) ->
		@ctx = @canvas.getContext '2d'
		@width = @canvas.width
		@height = @canvas.height
		@units = []
		@active = no
		@fokus = new Vec2(@width/2, @height/2)
		@pushField = 100
		@interface = new UserInterface @

	tick: ->
		return if not @active
		curTime = do Date.now
		@curDiff = curTime - @lastTime
		do @update
		do @draw
		@lastTime = curTime
		animationLoop @tick.bind(@)

	start:->
		@active = yes
		@lastTime = do Date.now
		log @lastTime
		do @tick

	stop:->
		@active = no

	toggle:->
		log "toggle: #{if @active then 'stop' else 'start'}"
		if @active then do @stop else do @start

	update: ->
		for unit in @units
			unit.update @curDiff

	draw: ->
		@ctx.clearRect 0, 0, @width, @height
		@ctx.fillStyle = '#444'
		@ctx.fillRect 0, 0, @width, @height
		for unit in @units
			do unit.draw

	addUnit: (unit)->
		@units.push(unit)

	moveFokus:(e)->
		@fokus.set e.offsetX, e.offsetY

	mouseClick:(e) ->
		do @toggle



# BASE UNIT CLASS

class Unit
	constructor:()->
		@id = do Unit.nextId

	@nextId: ->
		@lastId++;

	@lastId: 1

# EJECTOR

class Ejector extends Unit
	constructor:(params)->
		super
		@world = params.world
		@pos = params.pos
		@parts = []
		@maxParticles = 200
		@addNum = 2
		@life = 1.5 # sec

	update:(time)->
		for part, index in @parts by -1
			part.update time
			@remove index if part.ended
		do @add if @parts.length < @maxParticles - @addNum

	remove:(index)->
		@addSecond(@parts[index]) if @parts[index].type == 'Part1'
		@parts.splice index, 1

	draw:->
		do @drawShape
		for part, index in @parts
			do part.draw

	drawShape:->
		ctx = @world.ctx
		ctx.strokeStyle = '#888'
		do ctx.beginPath
		ctx.arc @pos.x, @pos.y, 15, 0, 2 * Math.PI
		do ctx.closePath
		do ctx.stroke

	add:->
		do @addPart for num in [1..@addNum]

	addPart:->
		params =
			world: @world
			pos: do @pos.copy
			life: @life
		@addUnit(new Particle (params))

	addSecond:(part)->
		@addUnit(new SecondParticle (part))

	addUnit:(unit)->
		@parts.push(unit)

# PARTICLE

class Particle extends Unit
	constructor:(params)->
		super
		@type = 'Part1'
		@world = params.world
		@pos = params.pos
		@life = params.life ? 2 #sec
		@step = 150
		@gravity = new Vec2 0, -2
		@size = 5 # radius
		@pushFactor = 2
		@ended = no
		@direction = new Vec2(
			@gravity.x + @gravity.y/20 - Math.random() * @gravity.y/10,
			@gravity.y / 2 * Math.random() + @gravity.y / 2
		)
		@stepDir = @direction.copy().mult(@step)

	update:(time)->
		return if @ended
		subTime = time / 1000
		@life -= subTime
		@ended = yes if @life < 0
		pureStep = @stepDir.part(subTime)
		vectDist = @world.fokus.dist @pos
		scalarDist = vectDist.scalar()
		pushImpuls = @world.pushField/(pow(scalarDist, @pushFactor))
		pushStep = do vectDist.copy
		pushStep.mult(pushImpuls)
		@pos.add(pureStep).add(pushStep)

	draw:()->
		return if @ended
		ctx = @world.ctx
		ctx.fillStyle = '#ff2200'
		do ctx.beginPath
		ctx.arc @pos.x, @pos.y, @size, 0, 2 * Math.PI
		do ctx.closePath
		do ctx.fill

square = (x) -> x * x

pow = (num, exp) -> Math.pow(num, exp)

dist = (a,b) ->
	Math.sqrt(Math.pow(b.x - a.x, 2) + Math.pow(b.y - a.y, 2))

class SecondParticle extends Particle
	constructor:(params)->
		super params
		@type = 'Part2'
		@size = 10 # radius
		#@gravity = new Vec2 0, -1
		@maxLife = @life = .3
		@ended = no
		@direction = params.direction# .mult(.2)
		#log "#{@id} of(#{params.id} - #{params.type}) = #{@direction.y}" if @id %99 == 0
		@stepDir = @direction.copy().mult(@step)

	draw:()->
		return if @ended
		ctx = @world.ctx
		ctx.strokeStyle = '#eee'
		do ctx.beginPath
		ctx.arc @pos.x, @pos.y, (@size * (@life / @maxLife/2 + @maxLife/2)), 0, 2 * Math.PI
		do ctx.closePath
		do ctx.stroke

class ThirdParticle extends SecondParticle
	constructor:(params)->
		super params
		@step = 30
		@direction.x *= 2
		@stepDir = @direction.copy().mult(@step)

	draw:()->
		return if @ended
		ctx = @world.ctx
		ctx.fillStyle = '#111'
		do ctx.beginPath
		ctx.arc @pos.x, @pos.y, (@size), 0, 2 * Math.PI
		do ctx.closePath
		do ctx.fill

# INTERFACE

class UserInterface
	constructor:(@world) ->
		$(document).click (e) => @world.mouseClick e
		$(@world.canvas).mousemove (e)=> @world.moveFokus e

# INIT
$(window).load ()->
	world = new World document.getElementById 'display'
	world.addUnit (new Ejector {
		world: world
		pos: new Vec2 200, 550
	})
	world.addUnit (new Ejector {
		world: world
		pos: new Vec2 400, 550
	})
	world.addUnit (new Ejector {
		world: world
		pos: new Vec2 600, 550
	})
	do world.start
