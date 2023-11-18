function choose2(nom_menu, prix_menu){
    const elt = document.getElementById("choice");
    const elt2 = document.createElement("p");
    elt2.innerText= "Menu" + nom_menu + " : " + prix_menu + "€";
    elt.appendChild(elt2);
}   

function choose(){
    const elt = document.getElementById("choice");
    const elt2 = document.createElement("p");
    elt2.innerHTML= "bonjour";
    elt.appendChild(elt2);
    elt.style.color = "blue";
}   

function choose3(nom_menu, prix_menu){
    choose4();
    var table = document.getElementById("choice");
    var tr = document.createElement("tr");

    if (document.getElementById("quantite" + nom_menu)!=null){
        var td = document.getElementById("quantite" + nom_menu);
        var text = td.innerText;
        var quantite = Number(text)+1;
    }
    else{
        var quantite = 1;
    }

    if (document.getElementById('td_prix_total')!=null){
        var td = document.getElementById('td_prix_total');
        var text = td.innerText;
        var prix_total = Number(prix_menu) + Number(text);
        prix_total = prix_total.toFixed(2);
    }
    else{
        var prix_total = prix_menu;
    }

    const list = [nom_menu, prix_menu, quantite, prix_total];

    if (document.getElementById("quantite" + nom_menu)!=null){
        maj(list);
    }
    else{
        create(table,tr,list);
    }
}   


function maj(list){
    for (var j = 0; j < list.length; j++){
        var td = document.createElement('td');
        if (j==0){
            td = document.getElementById("nom" + list[0]);
        }
        if (j==1){
            td = document.getElementById("prix" + list[0]);
        }
        if (j==2){
            td = document.getElementById("quantite" + list[0]);
        }
        if (j==3){
            td = document.getElementById('td_prix_total');
        }
        td.innerText = list[j];
    }
}


function create(table, tr, list){
    for (var j = 0; j < list.length; j++){
        var td = document.createElement('td');
        if (j==0){
            td.id = "nom" + list[0];
        }
        if (j==1){
            td.id = "prix" + list[0];
        }
        if (j==2){
            td.id = "quantite" + list[0];
        }
        if (j==3){
            if (document.getElementById('td_prix_total')==null){
                td.id = 'td_prix_total';
            }
            else{
                td = document.getElementById('td_prix_total');
            }
        }
        td.innerText = list[j];
        tr.appendChild(td);
    }
    table.appendChild(tr);
}

function choose4(){
    var form = document.getElementById("formchoice");
    var div = document.createElement("div");
    var input = document.createElement("input");
    input.type = "checkbox";
    input.className = "test"
    var elem2 = document.createElement('label');
    elem2.innerHTML = "something";
    div.appendChild(input);
    div.appendChild(elem2);
    form.appendChild(div);
      
}

/*function confirmer2() {
    var table = document.getElementById("choice");
    let menu = table.rows[1].cells[2].innerHTML + " " + table.rows[1].cells[0].innerHTML;
    let prix;
    var n = table.rows.length;
    var p = document.createElement('p');
    p.id = "detail_commande";
    for (var i=2; i<n; i++){
        menu += " + " +table.rows[i].cells[2].innerHTML + " " + table.rows[i].cells[0].innerHTML;;
    }
    p.innerHTML = menu;
    document.getElementById("details2").appendChild(p);

    /*document.addEventListener("DOMContentLoaded", function() {
        var element = document.createElement("button");
        element.appendChild(document.createTextNode("Click Me!"));
        var page = document.getElementById("details2");
        page.appendChild(element);
    });*/
    /*for (var i=0; i<n; i++){
        var p = document.createElement('p');
        p.innerHTML = table.rows[i].innerHTML;
        //document.getElementById("details2").innerText = p;
        document.getElementById("details2").appendChild(p);
    }
}

function confirmer() {
    var table = document.getElementById("choice");
    var n = table.rows.length; 
    document.getElementById("details2").innerText = "yo";
    /*for (var i=0; i<n; i++){
        var p = document.createElement('p');
        p = table.rows[i].innerHTML;
        document.getElementById("details").appendChild = p;
    }
}*/