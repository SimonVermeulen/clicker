 	class Autoclicker {
  constructor(obj, counter, buttonPlace, idArray) {
    for (var prop in obj) this[prop] = obj[prop];

    this.counter = counter;
    this.button = null;
    this.buttonPlace = buttonPlace;
    this.idArray = idArray;
    this.createButton(buttonPlace, idArray);
  }

  static test(){
    return 'static method has been called.';
  }

  describe() {
  	var description = this.name + " " + this.price + " " + this.clicPS + " " + this.defaultClicPS + " " + this.numberOfUpgrade + " " + this.counter + " " + this.button + " " + this.possessed;
  	return description;
  }

  createButton(buttonPlace, idArray) {
  	buttonPlace.innerHTML += '<div id="' + this.instanceName + '" class="divButton"><img src="/../images/icones/' + this.instanceName + '" alt="' + this.instanceName + '" class="imgUpgrade"/><button onclick="counter.upgradeAutoclicker(' + this.idArray + ')" class="button" id="' + this.instanceName + '">' + this.name + "<br/>" + this.price + '</button></div>';
    this.button = document.getElementById(this.instanceName);
  }
  
  upgrade() {
    console.log(this.price);
    var isPayed = counter.payUpgrade(this.price);

    if(isPayed == 0) {
      this.clicPS = Math.round(this.clicPS) + Math.round(this.defaultClicPS);
      
      if(this.numberOfUpgrade == 0)
      {
        this.possessed = 1;
      	console.log("test");
      }
      
      this.numberOfUpgrade++;
      
      this.upPrice();
      counter.valueAugmentPS();
    }
    else {
      document.getElementById("errors").innerHTML = isPayed;
    }
  }

  upPrice() {
    var valueModulo = this.numberOfUpgrade % 20;

    this.price = Math.round(this.price);
    
    if(valueModulo == 0){
      if(this.multiplicateur < 1)
      {
        this.multiplicateur += 0.25;  
      }

      var price_step1 = this.price * this.multiplicateur;
      console.log(price_step1);
      price_step1 = Math.round(price_step1);
      console.log(price_step1);
      this.price = this.price + price_step1;
	  console.log(this.price);
      counter.resetButton();
    }
    else {
      var price_step1 = this.price * this.multiplicateur;
      price_step1 = Math.round(price_step1);
      console.log(price_step1);
      this.price = this.price + price_step1;
	  console.log(this.price);
      counter.resetButton();
    }
  }
}
