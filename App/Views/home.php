<h1>Bienvenue sur le chat</h1>

<h2>Utilisateurs connectés</h2>
<ul></ul>

<h2>Messages</h2>
<ul id="messages">
	
</ul>

<form method="post">
	<textarea rows="4" name="content"></textarea>
	<br/>
	<input type="submit" name="Envoyer">
</form>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

    refresh();

    function refresh() {
    	$.ajax(
        {
            type : "POST",
            dataType : "json",
            url : "/?p=chat.refresh",
            success : function (data) {
            	for (var i = 0; i < data.length; i++) {
            		var ul = document.getElementById("messages");
					var newLI = document.createElement("li");
					ul.appendChild(newLI);
					newLI.innerHTML = data[i];
            	}
            }
        });
    }
</script>