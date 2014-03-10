String[] lines; //used for grabbing original data
String[] pieces; //used to split original data into columns
String[][] data; //used to store information for graphing

Memes[] meme = new Memes[18];

PFont font; //font used for text (Impact)
/* @pjs font="Impact.ttf"; */
PImage logo;
PImage play;
PImage pause;

int gameState;

int week; //used for changing which week is displayed
int randomImage;

int time; //used for the slidebar
int prevWeek; //used for changing random images
int selectedMeme; //used to determine which meme has been selected
int animCounter; //used to play an animation of the trends

int dateState; //used to set week to correspond to either click or drag or animation

void setup() {
  size(1200, 800);
  background(255);
  imageMode(CENTER);
  frameRate(30);

  lines = loadStrings("report.csv"); //load country specific data
  splitData(); //splits data into two-dimensional array

  font = loadFont("Impact.ttf");
  textFont(font, 32);

  logo = loadImage("logo.png");
  play = loadImage("play.png");
  pause = loadImage("pause.png");
  
  gameState = 0;

  week = 63; //set to the middle week initially
  randomImage = 0;

  time = width/2;
  prevWeek = 0;
  animCounter = 0;

  dateState = 0; //false means that the program is in'drag' mode

  meme[0] = new Memes(0, 100, 140, "Overly-Attached Girlfriend");
  meme[1] = new Memes(1, 300, 140, "Scumbag Steve");
  meme[2] = new Memes(2, 500, 140, "Rage Faces");
  meme[3] = new Memes(3, 700, 140, "Grumpy Cat");
  meme[4] = new Memes(4, 900, 140, "One Does Not Simply...");
  meme[5] = new Memes(5, 1100, 140, "Bad Luck Brian");
  meme[6] = new Memes(6, 100, 340, "[10] Guy");
  meme[7] = new Memes(7, 300, 340, "Socially Awkward Penguin");
  meme[8] = new Memes(8, 500, 340, "Futurama Fry / Not Sure If");
  meme[9] = new Memes(9, 700, 340, "First World Problems");
  meme[10] = new Memes(10, 900, 340, "Success Kid");
  meme[11] = new Memes(11, 1100, 340, "Philosoraptor");
  meme[12] = new Memes(12, 100, 540, "Condescending Wonka");
  meme[13] = new Memes(13, 300, 540, "Conspiracy Keanu");
  meme[14] = new Memes(14, 500, 540, "Ermahgerd");
  meme[15] = new Memes(15, 700, 540, "Most Interesting Man");
  meme[16] = new Memes(16, 900, 540, "Slowpoke");
  meme[17] = new Memes(17, 1100, 540, "Sudden Clarity Clarence");
}

void draw() {
  background(255);
  if (dateState < 2) {
    drawMemes();
  }
  else if (dateState == 2) {
    animateMemes();
  }
  slideBar();

  //Draw date information
  fill(0);
  rect(0, 0, width, 40);
  fill(255);
  textAlign(CENTER, CENTER);
  textFont(font, 24);
  noStroke();
  text(data[week][0], width/2, 23);
  textFont(font, 11);
  text("WEEK OF", (width/2), 6);

  //Draw instructions
  textFont(font, 14);
  fill(255);
  textAlign(LEFT, CENTER);
  text("USE THE SLIDE BAR TO SEE THE TRENDS OF MEMES OVER TIME.", 20, 20);
  textAlign(RIGHT, CENTER);
  text("SELECT A MEME TO FIND OUT MORE INFORMATION", width-20, 20);

  //Draw background image and logo
  imageMode(CORNER);
  image(logo, 0, 660);
}

/*******************************************************/
/*****************OTHER FUNCTIONS***********************/
/*******************************************************/

void splitData() {
  data = new String[lines.length][19]; //set up 2D array - one dimension is number of rows, other is number of columns

  for (int i = 0; i<lines.length; i++) {
    pieces = split(lines[i], ";"); //split up original data into columns
    for (int j = 0; j<19; j++) {
      data[i][j] = pieces[j]; //put information into array
    }
  }
}

void drawMemes() {

  for (int i=0; i<18; i++) {
    meme[i].display();
  }

   if (gameState == 1) {
  meme[selectedMeme].drawGraph();
  meme[selectedMeme].drawSelected();
   }
}

void animateMemes() {


  if (animCounter % 5 == 0 && week<123) {
    week++;
  }

  for (int i=0; i<18; i++) {
    meme[i].display();
  }

  if (gameState == 1) {
  meme[selectedMeme].drawGraph();
  meme[selectedMeme].drawSelected();
  }

  time = int(map(week, 1, 123, 30, width-20));

  animCounter++;
}

void slideBar() {
  rectMode(CORNER);
  fill(200);
  noStroke();
  rect(0, 640, width, 20);

  fill(100);
  rect(time, 640, 10, 20);

  imageMode(CORNER);

  if (dateState < 2) {
    image(play, 0, 640);
  }

  else if (dateState == 2) {
    image(pause, 0, 640);
  }

  if (dateState == 0) {
    week = int(map(time, 30, width-20, 1, 123));
  }

  if (abs(week-prevWeek) >= 1 && abs(week-prevWeek) <= 2) {
    for (int i=0; i<18; i++) {
      meme[i].randomImage = int(random(10));
    }
  }

  prevWeek = week;
}

/*******************************************************/
/**************MOUSE AND KEYBOARD***********************/
/*******************************************************/

void mouseDragged() {
  if (mouseX>time-100 && mouseX < time+100 && mouseY > 500 && mouseY < 700 && mouseX >= 30 && mouseX<=width-20) {
    dateState = 0;
    time = mouseX;
    
  }
}

void mouseClicked() {
  if (mouseX>=30 && mouseX<=width-20 && mouseY>=640 && mouseY<=660) {
    dateState = 0;
    time = mouseX;
  }

  for (int i=0; i<18; i++) {
    if (mouseX > meme[i].x-100 && mouseX < meme[i].x+100 && mouseY > meme[i].y-100 && mouseY < meme[i].y+100) {
      gameState = 1;   
      if (dateState < 2) {
        week = meme[i].maxValue();
        int newWeek = week+1;
        time = int(map(newWeek, 1, 123, 30, width-20));
      }
      selectedMeme = i;
    }
  }

  if (mouseX > 0 && mouseX < 30 && mouseY > 640 && mouseY < 660) {
    if (dateState < 2) {
      dateState = 2;
    }

    else if (dateState == 2) {
      dateState = 0;
    }
  }
}

class Memes {

  PImage[] pic = new PImage[10];
  int x;
  int y;
  String[] info = new String[lines.length];
  String name;
  int randomImage;

  Memes(int place, int _x, int _y, String _name) {

    for (int i=0; i<10; i++) {
      pic[i] = loadImage(str(place) + "/" + str(i) + ".png");
    }

    x = _x;
    y = _y;

    for (int i=0; i<lines.length; i++) {
      info[i] = data[i][place+1];
    }

    name = _name;
    randomImage = 0;
  }

  void display() {
    imageMode(CENTER);
    rectMode(CENTER);
    pushMatrix();
    translate(x, y);
    noFill();
    stroke(170);
    strokeWeight(1);
    rect(0, 0, 200, 200);
    scale(map(int(info[week]), 0, 100, .25, 1));
    noFill();
    stroke(0);

    if (int(info[week]) > 0) {
      image(pic[randomImage], 0, 0);
    }
    popMatrix();

    if (mouseX > x-100 && mouseX < x+100 && mouseY > y-100 && mouseY < y+100) {
      fill(0, 125);
      noStroke();
      rect(x, y, 200, 200);
      rectMode(CENTER);
      textAlign(CENTER, CENTER);

      //      textFont(font, 18);
      //      fill(0);
      //      text(data[0][j], x+100,y+100);

      textFont(font, 17);
      fill(255);
      text(name, x, y);
    }
  }

  void drawGraph() {

    int counter = width-400;
    float point = 0;
    stroke(0);
    strokeWeight(1);

    for (int i = 0; i < info.length; i++) {

      //Take data from string and map population points.
      point = map(int(info[i]), 0, 100, height-10, height-100);
      //float distPoint = dist(counter, point, mouseX, mouseY);

      // I removed your larger if statement as it wasn't really doing anything.
      if (i > 0) { //only draw line between points after the first value of i (other wise null pointer exception)
        float p_point = map(int(info[i-1]), 0, 100, height-10, height-100);
        stroke(0);
        line(counter, point, counter-3, p_point);
      }

      //I added a roll over to inspect the valus and make sure I understood the code
      if (mouseX>counter-2 && mouseX<counter+2 && mouseY > 640 && mouseY < height) {
        textAlign(LEFT);
        fill(0);
        textSize(13);
        text(data[i][0], 810, height-90);
        // text(info[i], width-40, height-120);
        fill(0, 0, 255);
        noStroke();
        ellipse(800, height-95, 8, 8);
        ellipse(counter, point, 5, 5);
      }

      counter+=3;
    }

   // if (dateState == 2) {
      point = map(int(info[week]), 0, 100, height-10, height-100);
      counter = (width-400)+(week*3);
      textAlign(LEFT);
      fill(0);
      textSize(13);
      text(data[week][0], 810, height-110);
      // text(info[i], width-40, height-120);
      fill(255, 0, 0);
      noStroke();
      ellipse(800, height-115, 8, 8);
      ellipse(counter, point, 5, 5);
  //  }

    noFill();
    stroke(255, 0, 0);
    strokeWeight(2);
    rect(x, y, 200, 200);
  }

  void drawSelected() {

    imageMode(CORNER);

    pushMatrix();
    translate(470, 675);
    scale(.55);
    if (randomImage > 0) {
      image(pic[randomImage-1], 0, 0);
    }
    else {
      image(pic[randomImage+1], 0, 0);
    }
    popMatrix();

    fill(0);
    textAlign(LEFT);
    textFont(font, 16);
    text(name, 600, 690);

    stroke(0);
    line(600, 697, 780, 697);

    fill(70);
    textFont(font, 13);
    text("Date of Most Searches:", 600, 715); 
    text(data[maxValue()][0], 600, 730);
  }

  int maxValue() {
    int max = 0;
    int maxDate = 0;

    for (int i = 0; i < info.length; i++) {
      if (int(info[i]) > max) {
        max = int(info[i]);
        maxDate = i;
      }
    }
    return maxDate;
  }
}


