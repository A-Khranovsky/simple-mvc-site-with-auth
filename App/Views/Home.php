<?php


namespace App\Views;


class Home extends View
{
    public function authForm()
    {
        $title = 'Login';
        $body = <<<HTML
        <form method="POST" action="/api/home/login">
        Enter user name: <br>
        <input type="text" name="user" /><br>
        Enter password: <br>
        <input type="password" name="password" /><br>
        <input type="submit" value="Enter" />
        </form>
        HTML;

        $this->replacements = [
            '{{{title}}}' => $title,
            '{{{body}}}' => $body
        ];
        return $this;
    }

    public function home()
    {
        $title = 'Home';
        $body = <<<HTML
        <div>Hello, {$_SESSION['login']}</div>
        <br />
        <a href="/api/home?action=out">Exit</a>
        HTML;
        $this->replacements = [
            '{{{title}}}' => $title,
            '{{{body}}}' => $body
        ];
        return $this;
    }

    public function error($message)
    {
        $title = 'Error';
        $body = <<<HTML
        <h2>Error was occured:</h2>
        HTML;
        foreach ($message as $item){
            $body .= '<p>' . $item . '</p>';
        }
        $body .= <<<HTML
        <p></p>
        <br />
        <a href="/api/auth">Login</a>
        HTML;
        $this->replacements = [
            '{{{title}}}' => $title,
            '{{{body}}}' => $body
        ];
        return $this;
    }

}