<?php

$story = $this->story;

?>

<a class="headline" href="<?= $story->getUrl() ?>"><?= $story->getHeadline() ?></a>

<br />

<span class="details">
    <?= $story->getCreatedBy(); ?> |
    <?= $story->getCommentCount() ?> Comments |
    <?= date('n/j/Y g:i a', strtotime($story->getCreatedOn())) ?>
</span>

<?php if(isset($_SESSION['AUTHENTICATED'])) { ?>
<form method="post" action="/comment/create">
    <input type="hidden" name="story_id" value="<?= $story->getId() ?>" />
    <textarea cols="60" rows="6" name="comment"></textarea><br />
    <input type="submit" name="submit" value="Submit Comment" />
</form>
<?php
}


foreach($this->comments as $comment) {
echo '
<div class="comment"><span class="comment_details">' . $comment['created_by'] . ' | ' .
                date('n/j/Y g:i a', strtotime($story['created_on'])) . '</span>
    ' . $comment['comment'] . '</div>
';
}