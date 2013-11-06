<h2>

<h2>
<?php if(empty($posts)) : ?>
        <?=$user->first_name?> is not following any other users at this time...
<?php endif; ?>
</h2>

<!--pre>
<?php print_r($posts) ?>
</pre-->

<?php foreach($posts as $post): ?>
   <article>

    <?=$post['first_name'] ?> <?=$post['last_name'] ?>> on:
    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>:
    </time>
    <p>"<?=$post['content']?>"</p>
    <hr>


   </article>

<?php endforeach; ?>
