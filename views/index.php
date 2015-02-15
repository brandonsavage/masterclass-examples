<ol>

<?php
/** @var Masterclass\Entity\Story $story */
foreach ($this->stories as $story) {
    echo '
    <li>
        <a class="headline" href="' . $story->getUrl() . '">' . $story->getHeadline() . '</a><br />
                <span class="details">' . $story->getCreatedBy() . ' | <a href="/story?id=' . $story->getId() . '">' . $story->getCommentCount() . ' Comments</a> |
                ' . date('n/j/Y g:i a', strtotime($story->getCreatedOn())) . '</span>
    </li>
    ';
}

?>

</ol>