console.log("JS fut!");

let xhrFeladat = new XMLHttpRequest();
xhrFeladat.open("GET", "../api/feladatok.php");
xhrFeladat.send();

xhrFeladat.onreadystatechange = function () {
  if (xhrFeladat.readyState != 4) return;

  if (xhrFeladat.status !== 200) {
    console.log("Feladat hiba:", xhrFeladat.status, xhrFeladat.responseText);
    return;
  }

  let adatok = JSON.parse(xhrFeladat.responseText);

  document.getElementById("OsszesFeladat").innerText = adatok.length + " db";

  let tbody = document.getElementById("Torzs");
  tbody.innerHTML = "";

  let OsszesKesz = 0;

  for (let i = 0; i < adatok.length; i++) {

    let adat = adatok[i];

    let tr = document.createElement("tr");

    // Név
    let td1 = document.createElement("td");
    td1.appendChild(document.createTextNode(adat.Nev));

    // Dátum
    let td2 = document.createElement("td");
    td2.appendChild(document.createTextNode(adat.Datum));

    // Kész switch
    let td3 = document.createElement("td");

    let div = document.createElement("div");
    div.className = "form-check form-switch";

    let input = document.createElement("input");
    input.className = "form-check-input";
    input.type = "checkbox";
    input.checked = Boolean(adat.Kesz);

    if (adat.Kesz) {
      OsszesKesz++;
    }

    input.addEventListener("change", function () {
      let xhr = new XMLHttpRequest();

      xhr.open("POST", "../api/FeladatKesz.php");
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.send(
        "ID=" + adat.ID +
        "&Kesz=" + (input.checked ? 1 : 0)
      );
    });

    div.appendChild(input);
    td3.appendChild(div);

    //MÓDOSÍTÁS GOMB
    let tdModositas = document.createElement("td");
    let ModositasGomb = document.createElement("button");

    ModositasGomb.className = "btn btn-warning btn-sm";
    ModositasGomb.innerText = "Módosítás";

    ModositasGomb.onclick = function () {

      console.log("MÓDOSÍTAS KATTINTAS");
      let UjNev = prompt("Új név:", adat.Nev);
      if (UjNev == null) return;

      let UjDatum = prompt("Új dátum (YYYY-MM-DD):", adat.Datum);
      if (UjDatum == null) return;

      let xhrModositas = new XMLHttpRequest();
      xhrModositas.open("PUT", "../api/feladatok.php");
      xhrModositas.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");

      xhrModositas.onreadystatechange = function () {
        if (xhrModositas.readyState != 4) return;

        if (xhrModositas.status == 200) {
          location.reload();
        } else {
          alert("Módosítás hiba: " + xhrModositas.status);
          console.log(xhrModositas.responseText);
        }
      };

      let body =
        "ID=" + encodeURIComponent(adat.ID) +
        "&Nev=" + encodeURIComponent(UjNev) +
        "&Datum=" + encodeURIComponent(UjDatum);

      console.log(body);
      xhrModositas.send(body);
    };

    tdModositas.appendChild(ModositasGomb);

    //ÖSSZERAKÁS
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(tdModositas);

    tbody.appendChild(tr);
  }

  document.getElementById("OsszesKesz").innerText = OsszesKesz + " db";
};
