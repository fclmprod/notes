/* StLucophone - Software - V 0.2
 * - Simple oscillation generator.
 * - Mouse following particles 
 */

import ddf.minim.*;
import ddf.minim.ugens.*;
 
Minim       minim;
AudioOutput out;
Oscil       wave;
Delay accelerationDelay;

// nombres de particules
int num = 5000; 
Particle[] particle = new Particle[num];

void setup(){
  noCursor();
  
  // Plein ecran
  size(1248, 800, P3D);
  background(255);
  
  // Anti Aliasing
  smooth();
  noStroke();
  //fill particle array with new Particle objects
  for(int i=0; i<particle.length; i++){
    particle[i] = new Particle(new PVector(random(0, width), random(0, height)), 2, 5,10);
  }
  
  minim = new Minim(this);
  // Creation de la sortie sonore.
  out = minim.getLineOut();
  // Synthese d'une onde sinusoidale.
  wave = new Oscil( 10, 0.1f, Waves.SINE );
  // Creation d'un delai avec feedback et preservation de l'entrée.
  accelerationDelay = new Delay( 0.5, 0.5, true, true );
  // Application de l'effet puis sortie du son.
  wave.patch(accelerationDelay).patch(out);
  
  
}
 
void draw() {
  // /!\ Bug ? Sans background le sketch ne se lance pas.
 background(0,0,0,0);
 
  // Suivi de la souris.
  for(int i=0; i<particle.length; i++){
    particle[i].run(mouseX, mouseY);
  }
}
 
void mouseMoved(){
  // Distance du centre à la souris
  float d = dist(width/2, height/2, mouseX, mouseY);
   // Distance maximale du centre aux bords.
  float maxD = dist(0, 0, width/2, height/2);
  
  // Amplitude de l'oscillation.
  // En fonction du la position Y de la souris/
  float amp = map( d, 0, height, 1, 0 );
  wave.setAmplitude( amp );
  
  // Fréquence de l'oscillation
  // En fonction du la position X de la souris.
  float freq = map( d, 0, width, 110, 880 );
  wave.setFrequency( freq );

  // Temps du delai
  // En fonction de l'eloignement de la souris du centre.
  float delayTime = map( d, maxD, 0, 0.0001, 0.9 );
  accelerationDelay.setDelTime( delayTime );
 
  // Deedback du delai
  // En fonction de l'eloignement de la souris du centre.
  float feedbackFactor = map( d, maxD, 0, 1, 0 );
  accelerationDelay.setDelAmp( feedbackFactor );
}
 
void keyPressed() { 
  // Changement PROVISOIRE des formes de courbes
  switch( key ) {
    case '1': wave.setWaveform( Waves.SINE ); break;
    case '2': wave.setWaveform( Waves.TRIANGLE ); break;
    case '3': wave.setWaveform( Waves.SAW ); break;
    case '4': wave.setWaveform( Waves.SQUARE ); break;
    case '5': wave.setWaveform( Waves.QUARTERPULSE ); break;
    default: break; 
  }
}

class Particle{
  
  PVector location;
  PVector velocity;
  PVector acceleration;
  int size;
  float gravity;
  float mass;
  int velocityLimit = 1;
  float d;
  float fromMouse;
  float maxD = dist(0, 0, width/2, height/2);
  
  Particle(PVector _location, int _size, float _gravity, float _mass){
    location = _location.get(); 
    velocity = new PVector(0, 0);
    acceleration = new PVector(0, 0);
    size = _size;
    gravity = _gravity;
    mass = _mass;
  }
  
  void display(){
    ellipseMode(CENTER);
    fill(0, d, 255);
    fromMouse = dist(width/2, height/2, mouseX, mouseY);
    ellipse(location.x, location.y, map(fromMouse,0,maxD,0,3), map(fromMouse,0,maxD,0,3));
    
    fill(0,0,200,map(fromMouse,0,maxD,0,200));
    ellipse(mouseX,mouseY,map(fromMouse,0,maxD,2,30),map(fromMouse,0,maxD,2,30));
  }

  void forces(float tx, float ty){
    PVector targetLoc = new PVector(tx, ty);
    PVector dir = PVector.sub(location, targetLoc);
    d = dir.mag();
    dir.normalize();
    
    if(keyPressed){
      dir.mult(1);
    }
    else{
      float rr = random(0,1);
       if(rr > 0.45f){
         dir.mult(1);
        }
        else{
          dir.mult(-2);
      }
    }
    applyForce(dir);
  }
   
  void applyForce(PVector force){
    force.div(mass);
    acceleration.add(force);
  }
   
  //method to update the location of the particle, and keep its velocity within a set limit
  void update(){
    velocity.add(acceleration);
    velocity.limit(velocityLimit);
    location.add(velocity);
    acceleration.mult(0);
  }
  
  // Reaparition des particules sur le bord opposé
  void bounds(){
    if(location.y > height){
      location.y = 0;
    }
    if(location.y < 0){
      location.y = height;
    }
    if(location.x > width){
      location.x = 0;
    }
    if(location.x < 0){
      location.x = width;
    }
  }
  
  // Combinaison des fonctions
  
  void run(float tx, float ty){
    forces(tx, ty);
    display();
    bounds();
    update();
  }
}