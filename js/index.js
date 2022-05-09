var clickButtonEmplacement = document.getElementById("clickButtonEmplacement");
var upgradeEmplacement = document.getElementById("upgradeEmplacement");
var upgradeEmplacementTest = document.getElementById("upgradeEmplacement2")
var displayCounter = document.getElementById("clickCounter");
var errors = document.getElementById("errors");
var boutonsave = document.getElementById("tes");

var counter = new Counter(test3, displayCounter, upgradeEmplacement);

var tableau2 = [];
var tableau3 = [];
var testTableau = [];

test.forEach(function(objects){
	var testparse = JSON.parse(objects);
	tableau2.push(testparse);
});

var clicker = new Clicker(tableau2[0], upgradeEmplacement);

test2.forEach(function(objects){
	var testParse = JSON.parse(objects);
	tableau3.push(testParse);
})

console.log(tableau3[0].instanceName);

if(tableau3[0].instanceName != "batterie")
{
  tableau3.reverse();
}




var i = 0;

tableau3.forEach(function(objects){
  	console.log(objects);
    testTableau.push(objects.instanceName = new Autoclicker(objects, displayCounter, upgradeEmplacement, i));
    i++;
})

/*var amelio1 = new Autoclicker("Ornithorynque", "amelio1", 50, 0, 2, 0, displayCounter, upgradeEmplacement, 0);
var amelio2 = new Autoclicker("Qwerty", "amelio2",75, 0, 4, 0, displayCounter, upgradeEmplacement, 0);
var amelio3 = new Autoclicker("Azerty", "amelio3",20, 0, 3, 0, displayCounter, upgradeEmplacement, 0);

var testTableau = [amelio1, amelio2, amelio3];

counter.setArrayClicPS(testTableau);
*/


counter.setArrayClicPS(testTableau);
counter.setClicker(clicker);

var myInterval = setInterval(incrementPS, 1000);

function incrementPS() {
	counter.incrementClicPS();
}

$('#save').click(function(){
  var tableau = [];
    testTableau.forEach(function(objects){
    	var testStringify = JSON.stringify(objects);
        tableau.push(testStringify);
    });
    var clickerStringify = JSON.stringify(clicker);

    var value = counter.value;
  
  	console.log(value);
	$.ajax({
		url: '/save.html',
    	type: "POST",
	    data: {array: tableau, clicker: clickerStringify, value: value},
		success: function(data){
			$('#data').text(data);
		}
	});

});
