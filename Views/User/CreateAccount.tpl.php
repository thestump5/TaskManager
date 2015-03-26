<html>
    <body>
        <h1>Create form:</h1>
        <?php
            $arg = filter_input(INPUT_GET, 'argc');
            if ( TRUE == strpos( $arg, 'Account' ) ):
        ?>
        <form action="http://localhost?action=Create&argc=User\User&argv=transaction,1" method="post">
            <label>
                Личная информация
            </label>
            <br />
            <input name="name" style="margin-top:10px" />
            <br />
            <input name="family" style="margin-top:10px" />
            <br />
            <input name="address" style="margin-top:10px" />
        <?php
            elseif ( TRUE == strpos( $arg, 'User' ) || FALSE == strpos( $arg, 'Account' ) ):
        ?>
        <form action="http://localhost?action=Create&argc=User\Account" method="post">
            <label>
                Информация аккаунта
            </label>
            <br />
            <input name="id" style="margin-top:10px" />
            <br />
            <input name="pw" type="password" style="margin-top:10px" />
        <?php
            endif;
        ?>
            <br />            
            <input type="submit" style="margin-top:10px" />
        </form>
        <a href="?action=Login">Login</a>
    </body>
</html>