let gameStarted = false;
let gameInterval;

function stopGame() {
  gameStarted = false;
  clearInterval(gameInterval);
  gameInterval = undefined;
}
stopGame();