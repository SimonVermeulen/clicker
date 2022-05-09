class Clicker {
    constructor(obj, buttonUpgradePlace) {
        for (var prop in obj) this[prop] = obj[prop];

        this.button = null;
        this.buttonUpgradePlace = buttonUpgradePlace;

        this.createUpgradeButton(buttonUpgradePlace);
    }

    describe() {
        var description = this.name + " " + this.instanceName + " " + this.price + " " + this.clic + " " + this.defaultClic + " " + this.numberOfUpgrade + " " + this.bouton;
        return description;
    }

    createUpgradeButton(buttonUpgradePlace) {
        buttonUpgradePlace.innerHTML += '<div id="' + this.instanceName + '" class="divButton"><img src="/../images/icones/' + this.instanceName + '" alt="' + this.instanceName + '" class="imgUpgrade"/><button onclick="' + this.instanceName + "." + 'upgrade()" class="button" id="test">' + this.nameUpgrade + "<br/>" + this.price + '</button></div>';
    }

    upgrade() {
        var isPayed = counter.payUpgrade(this.price);

        if(isPayed == 0) {
	      this.clicPC = Math.round(this.clicPC) + Math.round(this.defaultClicPC);
          
          this.numberOfUpgrade++;
          
          this.upPrice();
          counter.valueAugmentPC();
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
      price_step1 = Math.round(price_step1);
      this.price = this.price + price_step1;

      counter.resetButton();
    }
    else {
      var price_step1 = this.price * this.multiplicateur;
      price_step1 = Math.round(price_step1);
      this.price = this.price + price_step1;

      counter.resetButton();
    }
  }
}
