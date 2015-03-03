<html>
    <body>
        <h1>Create form:</h1>
        <form action="http://localhost" method="get">
            <input type="hidden" value="UserCreate" name="action" />
            <input name="name" style="margin-top:10px" />
            <br />
            <input name="family" style="margin-top:10px" />
            <br />
            <input name="address" style="margin-top:10px" />
            <br />            
            <input type="submit" style="margin-top:10px" />
        </form>
        <a href="?action=UserLogin">Login</a>
    </body>
</html>