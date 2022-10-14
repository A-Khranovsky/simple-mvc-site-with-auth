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

}