<?php

class Button
{
    public $state;
    public $count;

    public function __construct($state, $count)
    {
        $this->state = $state;
        $this->count = $count;
    }

    public function render()
    {
        $likeClass = 'like-button ' . $this->state;
        $likeCount = '<span class="like-count">' . $this->count . '</span>';

        echo '<button type="button" class="' . $likeClass . '" onclick="likeClick(event)">';
        echo '  <i class="fas fa-thumbs-up"></i>';
        echo '  ' . $likeCount;
        echo '</button>';
    }
}

$button = new Button('off', 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    if ($button->state == 'off') {
        $button->state = 'on';
        $button->count++;
    } else {
        $button->state = 'off';
        $button->count--;
    }
}

?>

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .like-button {
            background-color: white;
            border: none;
            cursor: pointer;
            display: inline-block;
            padding: 5px 10px;
        }

        .like-button.on {
            background-color: blue;
            color: white;
        }

        .like-count {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <?php $button->render(); ?>
    <?php $button->render(); ?>

    <script>
        function likeClick(event) {
            event.preventDefault();
            var form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.style.display = 'none';
            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'like');
            input.setAttribute('value', 'true');
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>