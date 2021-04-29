<html>
<head>
<style>
#center{
width: 80%;
margin-left: auto;
margin-right: auto;
align-content:center;
text-align:center;

height:99%;
padding:0px;
}
canvas, body{
padding: 0px;
margin:0px;
}
</style>
</head>
<body>
<div id="center">
<canvas id="canvas" width="550px" height="550px"></canvas>
</div>
<span id="endGame"></span>
<script>
//it works here because canvas will be written out before
//the code gets written out
// Canvas Pong

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
//create array of pong balls so we can have more than 1
var balls = [];
// Key Codes
var W = 87;
var S = 83;
var UP = 38;
var DOWN = 40;

// Keep track of pressed keys
var keys = {
  W: false,
  S: false,
  UP: false,
  DOWN: false
};

// Create a rectangle object - for paddles, ball, etc
function makeRect(x, y, width, height, speed, color) {
  if (!color) color = '#000000';
  return {
    x: x,
    y: y,
    w: width,
    h: height,
    s: speed,
    c: color,
    draw: function() {
      context.fillStyle = this.c;
      context.fillRect(this.x, this.y, this.w, this.h);
    }
  };
}
var swapped = false;
// Create the paddles
var paddleWidth = 25;
var paddleHeight = 100;
var leftPaddle = makeRect(25, canvas.height / 2 - paddleHeight / 2, paddleWidth, paddleHeight, 5, '#BC0000');
var rightPaddle = makeRect(canvas.width - paddleWidth - 25, canvas.height / 2 - paddleHeight / 2, paddleWidth, paddleHeight, 5, '#0000BC');

//why not rotate the canvas 20degrees every 5 sec?
var deg = 0;
window.setInterval(function(){
	deg+= 20;
	canvas.style.transform = "rotate(" + deg + "deg)";
}, 5000);
//end rotate

// Keep track of the score
var leftScore = 0;
var rightScore = 0;

// Create the ball
var ballLength = 15;
var ballSpeed = 2;
//create X pong balls
/*
had to wrap all pong ball interaction inside functions
we have it loop during the "game loop" then pass each ball
to the function and process the logic per ball
*/
var ballsToSpawn = 300000;
for(let i = 0; i < ballsToSpawn; i++){
	
	setTimeout(function(){
		let ball = makeRect(0, 0, ballLength, ballLength, ballSpeed, '#000000');
		balls.push(ball);
		ball.sX = ballSpeed;
		ball.sY = ballSpeed/2;
		randomDir(ball);
	}, 500 * i);
	
}
function randomDir(ball){
	// Randomize initial direction
	if (Math.random() > 0.5) {
	  ball.sX *= -1;
	  console.log("Invert X");
	}
	// Randomize initial direction
	if (Math.random() > 0.5) {
	  ball.sY *= -1;
	  console.log("Invert y");
	}
}


// Reset all
function resetBalls() {
	for(let i = 0; i < balls.length; i++){
		let ball = balls[i];
	  resetBall(ball);
  }
}
//reset one
function resetBall(ball){
	ball.x = canvas.width / 2 - ball.w / 2;
	  ball.y = canvas.height / 2 - ball.w / 2;
	  ball.sX = ballSpeed;
	  ball.sY = ballSpeed / 2;
	  
	randomDir(ball);
}



// Listen for keydown events
window.addEventListener('keydown', function(e) {
  if (e.keyCode === W) {
    keys.W = true;
  }
  if (e.keyCode === S) {
    keys.S = true;
  }
  if (e.keyCode === UP) {
    keys.UP = true;
  }
  if (e.keyCode === DOWN) {
    keys.DOWN = true;
  }
});

// Listen for keyup events
window.addEventListener('keyup', function(e) {
  if (e.keyCode === W) {
    keys.W = false;
  }
  if (e.keyCode === S) {
    keys.S = false;
  }
  if (e.keyCode === UP) {
    keys.UP = false;
  }
  if (e.keyCode === DOWN) {
    keys.DOWN = false;
  }
});

// Show the menu
function menu() {
  erase();
  // Show the menu
  context.fillStyle = '#000000';
  context.font = '24px Arial';
  context.textAlign = 'center';
  context.fillText('PONG', canvas.width / 2, canvas.height / 4);
  context.font = '18px Arial';
  context.fillText('Click to Start', canvas.width / 2, canvas.height / 3);
  context.font = '14px Arial';
  context.textAlign = 'left';
  context.fillText('Player 1: W (up) and S (down)', 5, (canvas.height / 3) * 2);
  context.textAlign = 'right';
  context.fillText('Player 2: UP (up) and DOWN (down)', canvas.width - 5, (canvas.height / 3) * 2);
  // Start the game on a click
  canvas.addEventListener('click', startGame);
}

// Start the game
function startGame() {
	// Don't accept any more clicks
  canvas.removeEventListener('click', startGame);
  // Put the ball in place
  resetBalls();
  // Kick off the game loop
  draw();
}

// Show the end game screen
function endGame() {
	erase();
  context.fillStyle = '#000000';
  context.font = '24px Arial';
  context.textAlign = 'center';
  var winner = 1;
  if (rightScore === 10) winner = 2;
  context.fillText('Player ' + winner + ' wins!', canvas.width/2, canvas.height/2);
  let eg = document.getElementById("endGame");
  eg.innerHTML = "<button onclick='reload();'>Press me</button>";
  
 
}
function reload(){
	location.reload();
}
// Clear the canvas
function erase() {
  context.fillStyle = '#FFFFFF';
  context.fillRect(0, 0, canvas.width, canvas.height);
}
function move(ball){
	// Move the ball
  ball.x += ball.sX;
  ball.y += ball.sY;
}
function bounceBall(ball){
// Increase and reverse the X speed
	if (ball.sX > 0) {
  	ball.sX += 1;
    // Add some "spin"
    if (keys.UP) {
      ball.sY -= 1;
    } else if (keys.DOWN) {
      ball.sY += 1;
    }
  } else {
  	ball.sX -= 1;
    // Add some "spin"
    if (keys.W) {
      ball.sY -= 1;
    } else if (keys.S) {
      ball.sY += 1
    }
  }
  ball.sX *= -1;
}
function hitPaddle(ball){
// Bounce the ball off the paddles
  if (ball.y + ball.h/2 >= leftPaddle.y && ball.y + ball.h/2 <= leftPaddle.y + leftPaddle.h) {
    if (ball.x <= leftPaddle.x + leftPaddle.w) {
      bounceBall(ball);
    }
  } 
  if (ball.y + ball.h/2 >= rightPaddle.y && ball.y + ball.h/2 <= rightPaddle.y + rightPaddle.h) {
    if (ball.x + ball.w >= rightPaddle.x) {
      bounceBall(ball);
    }
  }
  
}
function bounce(ball){

  // Bounce the ball off the top/bottom
  if (ball.y < 0 || ball.y + ball.h > canvas.height) {
    ball.sY *= -1;
  }
}
function checkScore(ball){
	// Score if the ball goes past a paddle
  if (ball.x < leftPaddle.x) {
    rightScore++;
	swapped = false;
    resetBall(ball);
    ball.sX *= -1;
  } else if (ball.x + ball.w > rightPaddle.x + rightPaddle.w) {
    leftScore++;
	swapped = false;
    resetBall(ball);
    ball.sX *= -1;
  }
}
// Main draw loop
function draw() {
  erase();
  // Move the paddles
  if (keys.W) {
    leftPaddle.y -= leftPaddle.s;
  }
  if (keys.S) {
    leftPaddle.y += leftPaddle.s;
  }
  if (keys.UP) {
    rightPaddle.y -= rightPaddle.s;
  }
  if (keys.DOWN) {
    rightPaddle.y += rightPaddle.s;
  }
  
  
  // Don't let the paddles go off screen
  [leftPaddle, rightPaddle].forEach(function(paddle) {
    if (paddle.y < 0) {
      paddle.y = 0;
    } 
    if (paddle.y + paddle.h > canvas.height) {
      paddle.y = canvas.height - paddle.h;
    }
  });
  for(let i = 0; i < balls.length; i++){
	let ball = balls[i];
	move(ball);
	bounce(ball);
	hitPaddle(ball);
	checkScore(ball);
	ball.draw();
  }
  
  swapIt();
  // Draw the paddles and ball
  leftPaddle.draw();
  rightPaddle.draw();
  // Draw the scores
  context.fillStyle = '#000000';
  context.font = '24px Arial';
  context.textAlign = 'left';
  context.fillText('Score: ' + leftScore, 5, 24);
  context.textAlign = 'right';
  context.fillText('Score: ' + rightScore, canvas.width - 5, 24);
  // End the game or keep going
  if (leftScore === 1000 || rightScore === 1000) {
  	endGame();
	
  } else {
  	window.requestAnimationFrame(draw);
  }
}

function swapIt(){
	if(swapped){
		return;
	}
	if(leftScore == 3 || rightScore == 3){
		let t = leftScore;
		leftScore = rightScore;
		rightScore = t;
		console.log("Swapped");
		swapped = true;
	}
}
// Show the menu to start the game
menu();
canvas.focus();
</script>
</body>
</html>