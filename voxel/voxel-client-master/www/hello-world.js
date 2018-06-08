var createClient = require('../')
var highlight = require('voxel-highlight')
var extend = require('extend')
var voxelPlayer = require('voxel-player')
var game

console.log("Require Fly");
var fly = require('voxel-fly')


module.exports = function(opts, setup) {
  setup = setup || defaultSetup
  opts = extend({}, opts || {})

  var client = createClient(opts.server || "ws://localhost:8080/")
  
  client.emitter.on('noMoreChunks', function(id) {
    console.log("Attaching to the container and creating player")
    var container = opts.container || document.body
    game = client.game
    game.appendTo(container)
    if (game.notCapable()) return game
    var createPlayer = voxelPlayer(game)

    // create the player from a minecraft skin file and tell the
    // game to use it as the main player
    var avatar = createPlayer('player.png')
    window.avatar = avatar
    avatar.possess()
    var settings = game.settings.avatarInitialPosition
    avatar.position.set(settings[0],settings[1],settings[2])

    setup(game, avatar, client)

  })

  return game
}

function defaultSetup(game, avatar, client) {
//fly code (hopefully)
console.log("MakeFly")
var makeFly = fly(game)

console.log("add controls")
makeFly(game.controls.target())

console.log("controls added")




  // highlight blocks when you look at them, hold <Ctrl> for block placement
  var blockPosPlace, blockPosErase
  var hl = game.highlighter = highlight(game, { color: 0xff0000 })
  hl.on('highlight', function (voxelPos) { blockPosErase = voxelPos })
  hl.on('remove', function (voxelPos) { blockPosErase = null })
  hl.on('highlight-adjacent', function (voxelPos) { blockPosPlace = voxelPos })
  hl.on('remove-adjacent', function (voxelPos) { blockPosPlace = null })

// block interaction stuff, uses highlight data
  var currentMaterial = 2

  // toggle between first and third person modes
  window.addEventListener('keydown', function (ev) {
    if (ev.keyCode === 'R'.charCodeAt(0)) avatar.toggle()
  })

  window.addEventListener('keydown', function (ev) {
    if (ev.keyCode == 49) currentMaterial = 2
  })

  window.addEventListener('keydown', function (ev) {
    if (ev.keyCode == 50) currentMaterial = 3
  })

  window.addEventListener('keydown', function (ev) {
    if (ev.keyCode == 51) currentMaterial = 4
  })

  window.addEventListener('keydown', function (ev) {
    if (ev.keyCode ==52 ) currentMaterial = 5
  }) 
  
   window.addEventListener('keydown', function (ev) {
    if (ev.keyCode ==53 ) currentMaterial = 6
  }) 

  game.on('fire', function (target, state) {
    var position = blockPosPlace
    if (position) {
      game.createBlock(position, currentMaterial)
      client.emitter.emit('set', position, currentMaterial)
    } else {
      position = blockPosErase
      if (position) {
        //if material is not material 1
		game.setBlock(position, 0)
        	console.log("Erasing point at " + JSON.stringify(position))
        	client.emitter.emit('set', position, 0)
	//end if
      }
    }
  })
}
