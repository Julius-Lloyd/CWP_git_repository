
let M1 = document.getElementById("M1"); 
let M2 = document.getElementById("M2"); 
let M3 = document.getElementById("M3"); 
let M4 = document.getElementById("M4"); 

document.querySelector('#alt-menu').onclick = function() { 
   M3.style.display = "block";
   M1.style.display = "block";
   M2.style.display = "block"; 
   M4.style.display = "block"; 
};
document.querySelector('#brunch').onclick = function() { 
   M1.style.display = "block";
   M2.style.display = "none";
   M3.style.display = "none"; 
   M4.style.display = "none";

};

document.querySelector('#s_bread').onclick = function() { 
   M1.style.display = "none";
   M2.style.display = "block"; 
   M3.style.display = "none";
   M4.style.display = "none"; 
};

document.querySelector('#frokost').onclick = function() { 
   M1.style.display = "none";
   M2.style.display = "block";
   M3.style.display = "block"; 
   M4.style.display = "none";
};


document.querySelector('#d_d').onclick = function() { 
   M1.style.display = "none";
   M2.style.display = "none";
   M3.style.display = "none"; 
   M4.style.display = "block";
};