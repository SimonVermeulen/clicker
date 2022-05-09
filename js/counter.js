class Counter {
	constructor(value, affichage, upgradePlace) {
		this.value = value;
		
		this.affichage = affichage;
		this.upgradePlace = upgradePlace;

		this.valueClicPS = 0;
		this.valueClicPC = 0;
		
		this.arrayClicPS = null;
		this.clicker = null;
      	this.lastUpgradeBuyed = null;
	}
	
  	upgradeAutoclicker(idArray)
  	{
		console.log(this.arrayClicPS[idArray]);
        this.arrayClicPS[idArray].upgrade();
    }
  
	describe() {
		var description = this.value + " " + this.affichage + " " + this.arrayClicPS + " " + this.clicker;
		return description;
	}

	setArrayClicPS(arrayClicPS) {
		this.arrayClicPS = arrayClicPS;
		this.valueAugmentPS();
	}

	setClicker(clicker) {
		this.clicker = clicker;
		this.valueAugmentPC();
	}

	payUpgrade(price) {
      	console.log(this.value);
      	console.log(price);
		var calcul = this.value - price;
      	console.log(calcul);
		if(calcul < 0){
			var error = "Vous n'avez pas assez de $";
			return error;
		}
		else{
			this.value = this.value - price;
			this.affichage.textContent = this.value;
			return 0;
		}
	}

	valueAugmentPS() {
		var valueAugmentPS = 0;
      	var instanceNameLastUpgraded = null
		var iphonePic = document.getElementById("phone");
        
        this.arrayClicPS.forEach(function(valueOfClicPS) {
			if(valueOfClicPS.possessed == 1)
            {
            	valueAugmentPS += parseInt(valueOfClicPS.clicPS);
              	console.log(valueOfClicPS.instanceName);
                instanceNameLastUpgraded = valueOfClicPS.instanceName;
              	if(instanceNameLastUpgraded != "netFixe")
                {
             		iphonePic.src = "/../images/" + instanceNameLastUpgraded + ".png";
                }
                else
                {
                	iphonePic.src = "/../images/Iphone-entier.png"
                }
            }
		});
			

		this.valueClicPS = valueAugmentPS;
	}

	valueAugmentPC() {
		var clicPC = parseInt(this.clicker.clicPC);
		this.valueClicPC = clicPC;
	}

	incrementClicPS() {
		this.value = this.value + this.valueClicPS;
		this.affichage.textContent = this.value;
	}

	incrementClic() {
	    this.value = this.value + this.valueClicPC;
		this.affichage.textContent = this.value;
	}

	resetButton() {
		this.upgradePlace.innerHTML = " ";

		this.clicker.createUpgradeButton(this.clicker.buttonUpgradePlace);
		this.arrayClicPS.forEach(function(clicPS) {
			clicPS.createButton(clicPS.buttonPlace);
		});
	}
}
