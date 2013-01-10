// JavaScript Document

function login() {
	var user=document.getElementById('logineid').value;
	var pass=document.getElementById('password').value;
	get_login(user,pass);
}


function get_login(user,pass) {
	new Request({
		url: 'login.php?u='+user+"&p="+pass,
		onSuccess: function (responseText) {
			if(responseText === '1'){
				//window.location.reload(true);
			}
			else
				alert('login.php?u='+user+"&p="+pass);
		}
	}).send();
}	

function logout() {
	new Request({
		url: 'logout.php',
		onSuccess: function (responseText) {
			//console.log('Response: ' +responseText);
			if(responseText === '1'){
				window.location.reload(true);
			}
				
		}
	}).send();
}	


function add_initial()
{
	var pups = document.getElementById('pups').value;
	var sups = document.getElementById('sups').value;
	var mile = document.getElementById('mtime').value;
	if((pups=='')||(sups=='')||(mile==""))
		alert("Please fill in all three values for the fitness test.");
	else{
		new Request({
			url: 'submit.php?table=fitness_test&type=initial&pups='+pups+'&sups='+sups+'&mile='+mile,
			method: 'get',
			onSuccess: function (responseText) {
				//console.log('Response: ' +responseText);
				if(responseText === '1'){
					window.location.reload(true);
				}
			}
		}).send();
	}
}

function add_goals()
{
	var pups = document.getElementById('pups').value;
	var sups = document.getElementById('sups').value;
	var mile = document.getElementById('mtime').value;
	if((pups=='')||(sups=='')||(mile==""))
		alert("Please fill in all three values for the fitness test.");
	else{
		new Request({
			url: 'submit.php?table=fitness_test&type=goals&pups='+pups+'&sups='+sups+'&mile='+mile,
			method: 'get',
			onSuccess: function (responseText) {
				//console.log('Response: ' +responseText);
				if(responseText === '1'){
					window.location.reload(true);
				}
			}
		}).send();
	}
}


function add_final()
{
	var pups = document.getElementById('pups').value;
	var sups = document.getElementById('sups').value;
	var mile = document.getElementById('mtime').value;
	if((pups=='')||(sups=='')||(mile==""))
		alert("Please fill in all three values for the fitness test.");
	else{
		alert('submit.php?table=fitness_test&type=final&pups='+pups+'&sups='+sups+'&mile='+mile);
		new Request({
			url: 'submit.php?table=fitness_test&type=final&pups='+pups+'&sups='+sups+'&mile='+mile,
			method: 'get',
			onSuccess: function (responseText) {
				//console.log('Response: ' +responseText);
				if(responseText === '1'){
					window.location.reload(true);
				}
			}
		}).send();
	}
}

function calorie_calc(){
	var selIndex = document.getElementById("select_exercise").selectedIndex;
	var id=document.getElementById("select_exercise").options[document.getElementById("select_exercise").selectedIndex].value;
	var weight=document.getElementById("current_weight").value;
	var time=document.getElementById("duration").value;
	if(id=="")
		alert(document.getElementById("select_exercise").value);
	if(weight=="")
		alert("Please enter your current weight.");
	else{
		if(time=="")
			calculate_calories(id,weight,'60');
		else
			calculate_calories(id,weight,time);
	}
}

// JavaScript Document
function calculate_calories(){
	//use arguments variable
	var form_load="?id="+arguments[0]+"&weight="+arguments[1]+"&time="+arguments[2];
	var counter=0;
	function new_rows(){
		counter=counter+1;
		//var selected=
		var myElement = document.getElementById('total');
		//alert('scripts/forms.php'+form_load);
		var myHTMLRequest = new Request({
		url: 'calculate.php'+form_load,
		method: 'get',
		onRequest: function() {
			myElement.innerHTML='';
		},
		onComplete: function(responseText) {
			var new_rows = new Element('div', {
				'html': responseText
			});
			// inject new fields at bottom
			myElement.innerHTML='';
			new_rows.inject(myElement,'bottom');
			
			//    remove loading image
		}
		}).send();
	}
	
	//load first set of rows - all rows are loaded via ajax
	new_rows();
	 		

}


function exercise_lookup(){
	var myElement = document.getElementById('select_exercise');
	document.getElementById("select_exercise").options.length = 0;
	var lookup=document.getElementById("lookup_exercise").value;
	if(lookup.length>2){
		var options = new Array();
		var myRequest = new Request.JSON({
			url: "lookup.php?search="+lookup,
			method: 'get',
			onRequest: function(){
			myElement.innerHTML='';
			},
			onSuccess: function(responseJSON){
			if(responseJSON.length>1){
					responseJSON.each (function (value){
					myElement.add(new Option(value.name,value.id));
		//myElement.insert(new Option(value.name,value.eid));
					});
			}
			else
				responseJSON.each (function (value){
					myElement.add(new Option(value.name,value.id, true, true));
					});
			},
			onFailure: function(){
			}
		}).send();
	}
}

function calculate_food_calories(){
	//use arguments variable
	var form_load="?id="+arguments[0]+"&type=food&amount="+arguments[1];
	var counter=0;
	function new_rows(){
		counter=counter+1;
		//var selected=
		var myElement = document.getElementById('total');
		//alert('scripts/forms.php'+form_load);
		var myHTMLRequest = new Request({
		url: 'calculate.php'+form_load,
		method: 'get',
		onRequest: function() {
			myElement.innerHTML='';
		},
		onComplete: function(responseText) {
			var new_rows = new Element('div', {
				'html': responseText
			});
			// inject new fields at bottom
			myElement.innerHTML='';
			new_rows.inject(myElement,'bottom');
			
			//    remove loading image
		}
		 
		}).send();
	}
	
	//load first set of rows - all rows are loaded via ajax
	new_rows();
	 		

}

function food_lookup(){
	var myElement = document.getElementById('select_food');
	document.getElementById("select_food").options.length = 0;
	var lookup=document.getElementById("lookup_food").value;
	if(lookup.length>2){
		var options = new Array();
		var myRequest = new Request.JSON({
			url: "lookup.php?type=food&search="+lookup,
			method: 'get',
			onRequest: function(){
				myElement.innerHTML='';
			},
			onSuccess: function(responseJSON){
			if(responseJSON.length>1){
					responseJSON.each (function (value){
					myElement.add(new Option(value.name,value.id));
		//myElement.insert(new Option(value.name,value.eid));
					});
			}
			else
				responseJSON.each (function (value){
					myElement.add(new Option(value.name,value.id, true, true));
					});
			},
			onFailure: function(){
				myElement.innerHTML='Sorry, your request failed';
			}
		}).send();
	}

}

function post_lookup(table, id){
	mywindow = window.open("blog_request.php?table="+table+"&id="+id, "", "location=1,status=1,scrollbars=1");
}

function validateForm(field)
{
	var str = document.getElementById(field).value;
	if (str == ""){
		alert("Please fill in the " +document.getElementById(field).name+" field before submitting."); 
		return false;
	}
	return (true);
}
	
function eid_lookup(){
	var myElement = document.getElementById('form_eid');
	document.getElementById("form_eid").options.length = 0;
	var lookup=document.getElementById("email").value;
	if(lookup.length>3){
		var temp=lookup.split('@');
		var options = new Array();
		var myRequest = new Request.JSON({
			url: "eid_lookup.php/?email="+temp[0],
			method: 'get',
			onRequest: function(){
				myElement.innerHTML='';
			},
			onSuccess: function(responseJSON){
			if(responseJSON.length>1){
					responseJSON.each (function (value){
					myElement.add(new Option(value.name+" "+value.department+" in "+value.division,value.eid));
		//myElement.insert(new Option(value.name,value.eid));
					});
			}
			else
				responseJSON.each (function (value){
					myElement.add(new Option(value.name+" "+value.department+" in "+value.division,value.eid, true, true));
					});
			},
			onFailure: function(){
				myElement.innerHTML='Sorry, your request failed'; 
			}
		}).send();
	}

}


function submit_activity()
{
	var weight = document.getElementById('current_weight').value;
	var duration = document.getElementById('duration').value;
	var date = document.getElementById('date').value;
	var challenge = document.getElementById('challenge').value;
	var fav = document.getElementById('fav').value;
	if(document.getElementById("fav_select_exercise").options[document.getElementById("fav_select_exercise").selectedIndex].value!='')
	var exercise = document.getElementById("fav_select_exercise").options[document.getElementById("fav_select_exercise").selectedIndex].value;
	else 
	 	var exercise = document.getElementById("select_exercise").options[document.getElementById("select_exercise").selectedIndex].value;
	alert('submit.php?table=wellness_log&exercise='+exercise+'&date='+date+'&duration='+duration+'&weight='+weight+'&challenge='+challenge+'&fav='+fav);
	new Request({
		url: 'submit.php?table=wellness_log&exercise='+exercise+'&date='+date+'&duration='+duration+'&weight='+weight+'&challenge='+challenge+'&fav='+fav,
		method: 'get',
		onSuccess: function (responseText) {
			//console.log('Response: ' +responseText);
			if(responseText === '1'){
				  window.opener.location.reload(true)
				  //opener.location.reload();
				  location.reload(true);          		
			}
		}
	}).send();
	
}

function submit_new_activity()
{
	var weight = document.getElementById('current_weight').value;
	var duration = document.getElementById('duration2').value;
	var date = document.getElementById('date').value;
	var challenge = document.getElementById('challenge').value;
	var new_exer = document.getElementById('new_exer').value;
	var calories = document.getElementById('calories').value;
	var fav = document.getElementById('fav').value;
	//alert('submit.php?table=wellness_log&exercise='+exercise+'&date='+date+'&duration='+duration+'&weight='+weight+'&challenge='+challenge);
	new Request({
		url: 'submit.php?table=wellness_log&new_exer='+new_exer+'&date='+date+'&duration='+duration+'&weight='+weight+'&challenge='+challenge+'&calories='+calories+'&fav='+fav,
		method: 'get',
		onSuccess: function (responseText) {
			//console.log('Response: ' +responseText);
			if(responseText === '1'){
				  window.opener.location.reload(true)
				  //opener.location.reload();
				  location.reload(true);      			}
		}
	}).send();
	
}

function add_exercise(date, id){
	mywindow = window.open("get_exer.php?date="+date+"&id="+id, "mywindow", "location=1,status=1,scrollbars=1,  width=800,height=800");

}


function food_calc(){
	var selIndex = document.getElementById("select_food").selectedIndex;
	var id=document.getElementById("select_food").options[document.getElementById("select_food").selectedIndex].value;
	var servings=document.getElementById("servings").value;
	if(id=="")
		alert("Please select a food from the drop down");
	if(servings=="")
		alert("Please enter how many servings you ate.");
	else{
		calculate_food_calories(id,servings);
	}
}

function submit_food()
{
	if ((document.getElementById("selected_meal").options[document.getElementById("selected_meal").selectedIndex].value=='')||(document.getElementById("selected_meal").options[document.getElementById("selected_meal").selectedIndex].value == "Not Selected")){
		alert("You did not select a meal.");
		return false;
	}
	if ((document.getElementById("select_food").options[document.getElementById("select_food").selectedIndex].value=='')||(document.getElementById("select_food").options[document.getElementById("select_food").selectedIndex].value == "Please select one")){
		alert("You did not select a food.");
		return false;
	}
	if (document.getElementById('servings').value==''){
		alert("You did not enter any servings.");
		return false;
	}
	return true;
}


function submit_new_food()
{
	var servings = document.getElementById('servings2').value;
	if((servings=='')||(servings=='0'))
		servings=1;
	var date = document.getElementById('date2').value;
	var challenge = document.getElementById('challenge').value;
	var new_food = document.getElementById('new_food').value
	var s_size = document.getElementById('s_size').value
	var calories = document.getElementById('calories').value
	var fat = document.getElementById('fat').value
	var s_fat = document.getElementById('s_fat').value
	var carbs = document.getElementById('carbs').value
	var meal = document.getElementById("select_meal2").options[document.getElementById("select_meal2").selectedIndex].value;	
	var fav = document.getElementById('fav').value;
	//alert('submit.php?table=wellness_log&food='+food+'&date='+date+'&servings='+servings+'&meal='+meal+'&fav='+fav);
	new Request({
		url: 'submit.php?table=wellness_log&new_food='+new_food+'&date='+date+'&servings='+servings+'&meal='+meal+"&challenge="+challenge+'&s_size='+s_size+'&fat='+fat+'&s_fat='+s_fat+'&calories='+calories+'&carbs='+carbs+'&fav='+fav,
		method: 'get',
		onSuccess: function (responseText) {
			 //console.log('Response: ' +responseText);
			if(responseText === '1'){
				  window.opener.location.reload(true);
				  //opener.location.reload();
				  location.reload(true);      			}
		}
	}).send();
	
}


function add_food(date, id){
	mywindow = window.open("get_diet.php?date="+date+"&id="+id, "mywindow", "location=1,status=1,scrollbars=1,  width=1200,height=1200");

}

function delete_item(id)
{
	var delete_this=confirm("Do you really want to delete this entry?");
	if(delete_this==true){
		new Request({
			url: 'submit.php?table=wellness_log&id='+id,
			method: 'get',
			onSuccess: function (responseText) {
				//console.log('Response: ' +responseText);
				if(responseText === '1'){
				  window.opener.location.reload(true)
				  //opener.location.reload();
				  location.reload(true);      				}
			}
		}).send();
	}
	
}

function set_goal(){
  	var myForm = document.getElementById('wellness');
    var myResult = document.getElementById('result');

  // Labels over the inputs.
  myForm.getElements('[type=text], textarea,[type=password]').each(function(el){
    new OverText(el);
  });

  // Validation.
  new Form.Validator.Inline(myForm);

  // Ajax (integrates with the validator).
  console.log('entering Submission AJAX');
  new Form.Request(myForm, myResult, {
    requestOptions: {
      'spinnerTarget': myForm
    },
	onSuccess: function(responseText,responseXML){ 
	 //console.log(responseText.get('html'));
		if(responseText.get('html') === '1'){
			window.location.reload(true);
		}
	}
  });	
}

function addentry(form, id, challenge){
  	var myForm = document.getElementById(form);
    var myResult = document.getElementById('result');

  // Labels over the inputs.
  myForm.getElements('[type=text], textarea,[type=password]').each(function(el){
    new OverText(el);
  });

  // Validation.
  new Form.Validator.Inline(myForm);

  // Ajax (integrates with the validator).
  console.log('entering Submission AJAX');
  new Form.Request(myForm, myResult, {
    requestOptions: {
      'spinnerTarget': myForm
    },
	onSuccess: function(responseText,responseXML){ 
	 //console.log(responseText.get('html'));
		if(responseText.get('html') === '1'){
			window.location.reload(true);
		}
	}
  });	
}

function show_div(div){	
	if(document.getElementById(div).style.display == 'none')
		document.getElementById(div).style.display = "";
	else if(document.getElementById(div).style.display == "")
		document.getElementById(div).style.display = 'none';
}
