let age = 17;
let isRegistered = false;

if(isRegistered && age >= 18) alert("Valid Voter")
else if(!isRegistered && age >= 18) alert("Register First")
else if(isRegistered && age < 18) alert("Invalid Voter")
else if(!isRegistered && age < 18) alert("Non Voter")