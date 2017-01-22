<h1>Bienvenue sur le chat</h1>
<a href="/?p=chat.logout">Se déconnecter</a>

<h2>Utilisateurs connectés</h2>
<ul id="users"></ul>

<h2>Messages</h2>
<ul id="messages"></ul>

<form method="post">
	<textarea rows="4" name="content"></textarea>
	<br/>
	<input type="submit" name="Envoyer">
</form>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

    refresh();

    setInterval(
        function () {
            refresh();
        }, 3000
    );

    function refresh() {
    	$.ajax(
        {
            type : "POST",
            dataType : "json",
            url : "/?p=chat.refresh",
            success : function(data) {
            	$("#messages").empty();
            	for (result in data) {
					$("#messages").append('<li><strong>' + data[result].user + '</strong> <i>[' + data[result].datetime + ']</i> :' + data[result].content + '</li>');
            	}
            }
        });

        $.ajax(
        {
            type : "POST",
            dataType : "json",
            url : "/?p=chat.checkConnection",
            success : function(data) {
            	$("#users").empty();
            	for (result in data) {
            		$("#users").append('<li>' + data[result] + '</li>');
            	}
            }
        });
    }
</script>