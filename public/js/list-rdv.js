function f(id,type,bool) {
    let res = fetch(`../factureCalcul.php?function=calculCost?id=${id}?${type}?${bool}`).then((response) => response.json()).then((data))

}