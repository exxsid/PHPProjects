<?php
class LikeButton
{
    private string $state = "like";


    public function display($id)
    {
        if ($this->state == "liked") {
            echo '<form>';
            echo '<button name="like" value="' . $this->state . ',' . $id . '" class="btn btn-primary mb-3">Like</button>';
            echo '</form>';
        } else {
            echo '<form>';
            echo
            '<button name="like" value="' . $this->state . ',' . $id . '">Like</button>';
            echo '</form>';
        }
    }

    public function handleButton($id)
    {
        if (isset($_GET['like']) && explode(",", $_GET['like'])[1] == $id) {
            if ($this->state == "liked") {
                $this->state = "like";
            } else {
                $this->state = "liked";
            }
            echo explode(",", $_GET['like'])[1];
        }
    }

    public function changeState()
    {
        if ($this->state == "liked") {
            $this->state = "like";
        } else {
            $this->state = "liked";
        }
    }
}
