
/**
*@desc: felugró popup ablak ami megkérdezi a felhasználót, hogy biztos akarja e törölni a sort
*@param:
*@return:
*/
function myFunction(x) {
	var y = x;
	if (confirm("Biztos törölni szeretnéd? Törléshez kattintson az OK gombra.") == true) {
		//alert(y);
        window.location.assign(y);
    } else {
		return false;
    }
 
}