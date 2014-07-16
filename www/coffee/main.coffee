# cd C:\Users\Less\IdeaProjects\phptest\www\coffee
# coffee -w -0 ./ *.coffee

log = (x) -> console.log(x) if console

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
		@maxParticles = 300
		@addNum = 2
		@life = 2 # sec
	#	@pos = new Vec2 400, 550

	update:(time)->
		for part, index in @parts by -1
			part.update time
			@remove index if part.ended
		do @add if @parts.length < @maxParticles - @addNum

	remove:(index)->
		@addSecond(@parts[index]) if @parts[index].type == 'Part1'
		#  instanceof SecondParticle #@parts[index] instanceof Particle and
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
		@step = 100
		@gravity = new Vec2 0, -2
		@size = 5 # radius
		@ended = no
		@direction = new Vec2(
			@gravity.x + @gravity.y/20 - Math.random() * @gravity.y/10,
			@gravity.y / 2 * Math.random() + @gravity.y / 2
		)
		#log @direction
		@stepDir = @direction.copy().mult(@step)

	update:(time)->
		return if @ended
		subTime = time / 1000
		@life -= subTime
		@ended = yes if @life < 0
		#@pos.add(@stepDir.part(subTime))

		pureStep = @stepDir.part(subTime)
		fokusDist = dist(@world.fokus, @pos) / 100
		vectDist = new Vec2( @pos.x - @world.fokus.x, @pos.y - @world.fokus.y).mult(1/10000)
		.mult(@world.pushField/(square(fokusDist)))
		pureStep.add(vectDist)
		@pos.add(pureStep)

	draw:()->
		return if @ended
		ctx = @world.ctx
		ctx.fillStyle = '#ff2200'
		do ctx.beginPath
		ctx.arc @pos.x, @pos.y, @size, 0, 2 * Math.PI
		do ctx.closePath
		do ctx.fill

square = (x) -> x * x

dist = (a,b) ->
	Math.sqrt(square(b.x - a.x) + square(b.y - a.y))

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
	#unit = new Ejector world
	#log unit
	#log "unit id = #{unit.id}"
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
