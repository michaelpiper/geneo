<!-- File: templates/Tags/index.php -->
<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5" style="width:100%;">
            <br/>
            <h1>Tags</h1>
            <div class="mx-5 text-center" style="width:100%;">
                <table class="data-table-load table table-striped table-bordered" style="width:90%;"> 
                    <thead>
                        <tr>
                            <th class="text-left">Title</th>
                            <th class="text-left">Created</th>
                            <th class="text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Here is where we iterate through our $tags query object, printing out tag info -->
                    <?php foreach ($tags as $tag): ?>
                    <tr>
                        <td>
                            <?= $this->Html->link($tag->title, ['action' => 'tag', $tag->id]) ?>
                        </td>
                        <td>
                            <?= $tag->created->format(DATE_RFC850) ?>
                        </td>
                        <td>
                        <?php if($this->Identity->get('admin')):?>
                        <?= $this->Html->link('Edit', ['action' => 'editTag', $tag->id]) ?>
                        
                        <?= $this->Html->link('Delete', ['action' => 'deleteTag', $tag->id],['confirm' => 'Are you sure?']) ?>
                        <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                   
                    <tfooter>
                        <tr>
                            <td colspan="3" style="border:0" ds=""> 
                                <h1 class="text-right">
                                    <?= $this->Html->link('Add Tag', ['action' => 'addTag']) ?>
                                </h1>   
                            </td>
                        </tr>
                    <tfooter>
                </table>
               
            </div>
            
        </div>
    </div>
</section>