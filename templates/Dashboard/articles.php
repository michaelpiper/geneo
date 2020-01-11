<!-- File: templates/Articles/index.php -->
<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5" style="width:100%;">
            <br/>
            <h1>Articles</h1>
            <div class="mx-5 text-center" style="width:100%;">
                <table class="data-table-load table table-striped table-bordered" style="width:90%;"> 
                    <thead>    
                        <tr>
                            <th class="text-left">Title</th>
                            <th class="text-left">Created</th>
                            <th class="text-left">Publish</th>
                            <th class="text-left">Action</th>
                        </tr>
                    </thead>

                    <!-- Here is where we iterate through our $articles query object, printing out article info -->
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <?= $this->Html->link($article->title, ['action' => 'article', $article->slug]) ?>
                            </td>
                            <td>
                                <?= $article->created->format(DATE_RFC850) ?>
                            </td>
                            <td>
                                <?= $this->Html->link(($article->published?'publish':'unpublish'), ['action' => ($article->published?'unpublishArticle':'publishArticle'), $article->slug],['confirm' => 'Are you sure you want to '.($article->published?'unpublish':'publish').' article?']) ?>
                            </td>
                            <td>
                                <?= $this->Html->link('Edit', ['action' => 'editArticle', $article->slug]) ?>
                                <?= $this->Html->link('Delete', ['action' => 'deleteArticle', $article->slug],['confirm' => 'Are you sure?']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfooter>
                        <tr>
                            <td colspan="4" style="border:0" ds=""> 
                                <h1 class="text-right">
                                    <?= $this->Html->link('Add Article', ['action' => 'addArticle']) ?>
                                </h1>   
                            </td>
                        </tr>
                    </tfooter>
                </table>
               
            </div>
            
        </div>
    </div>
</section>