<!-- To be able to use this template, you need to input the following variables from the php controller:

1- $tab_names which is an array that contains the title of each tab
2- $tab_contents which is an array of the content for each tab

IMPORTANT: these arrays should contain the tabs in the same order

-->


<script src="/public/js/tabs.js" defer></script>
<link href="/public/css/tabs.css" rel="stylesheet">

<div class="tabs">
    <ul class="tab_buttons">
    <?php $index = 0; ?>
    <?php if (isset($tab_names)) foreach ($tab_names as $tab_name): ?>
        <?php if($index == 0):?>
            <li data-tab-target = "#tab<?php echo $index?>" class="active tab"><?php echo $tab_name?></li>
        <?php else: ?>
            <li data-tab-target = "#tab<?php echo $index?>" class="tab"><?php echo $tab_name?></li>
        <?php endif; ?>
        <?php $index++; ?>
    <?php endforeach; ?>
    </ul>
</div>

<?php $index = 0; ?>
<?php if (isset($tab_names)) foreach ($tab_names as $tab_name): ?>

    <?php if($index == 0):?>
        <div class="page-content tab-content active" id="tab<?php echo $index?>" data-tab-content>
    <?php else: ?>
        <div class="page-content tab-content" id="tab<?php echo $index?>" data-tab-content>
    <?php endif; ?>

    <?php if (isset($tab_contents[$index])) echo $tab_contents[$index] ?>
    </div>
    <?php $index++; ?>

<?php endforeach; ?>
