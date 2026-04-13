console.log("JS fut!")

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
    let tr = document.createElement("tr");

    let td1 = document.createElement("td");
    td1.appendChild(document.createTextNode(adatok[i].Nev));

    let td2 = document.createElement("td");
    td2.appendChild(document.createTextNode(adatok[i].Datum));

    let td3 = document.createElement("td");

    let div = document.createElement("div");
    div.className = "form-check form-switch";

    let input = document.createElement("input");
    input.className = "form-check-input";
    input.type = "checkbox";
    input.checked = Boolean(adatok[i].Kesz);

    if (adatok[i].Kesz) {
      OsszesKesz++;
    }

    input.addEventListener("change", function () {
      let xhr = new XMLHttpRequest();

      xhr.open("POST", "../api/FeladatKesz.php");
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(
        "ID=" + adatok[i].ID +
        "&Kesz=" + (input.checked ? 1 : 0)
      );
    });

    div.appendChild(input);
    td3.appendChild(div);

    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);

    tbody.appendChild(tr);
  }

  document.getElementById("OsszesKesz").innerText = OsszesKesz + " db";
}
