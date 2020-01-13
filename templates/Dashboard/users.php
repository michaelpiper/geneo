<!-- File: templates/Users/index.php -->
<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5" style="width:100%;">
            <br/>
            <h1>Users</h1>
            <div class="mx-5 text-center" style="width:100%;">
                <table class="data-table-load table table-striped table-bordered" style="width:90%;"> 
                    <thead>
                        <tr>
                            <th class="text-left">Username</th>
                            <th class="text-left">Role</th>
                            <th class="text-left">Owner</th>
                            <th class="text-left">Active</th>
                            <th class="text-left">Created</th>
                            
                            <th class="text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Here is where we iterate through our $users query object, printing out user info -->
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?= $this->Html->link($user->username, ['action' => 'user', $user->id]) ?>
                        </td>
                        <td ><?=$user->admin?'Admin':'Author'?></td>
                        <td >
                            <?php if($this->Identity->get('owner') && $user->id !=$this->Identity->get('id')):?>
                                <?= $this->Html->link('tranfer ownership', ['action' => 'transferOwnership', $user->id],['confirm' => 'Are you sure you want to transfer ownership? this changes can\'t be reverted and to see effect please re login']) ?>
                            <?php else:?>
                                <?= ($user->owner==1)? 'True':'False'?>
                            <?php endif;?>
                        </td>
                        <td >
                            <?= ($user->active==1)? 'True':'False'?>
                        </td>
                        <td>
                            <?= $user->created->format(DATE_RFC850) ?>
                        </td>
                        
                        <td>
                        <?php if($this->Identity->get('admin')):?>
                            <?php if($user->id!=$this->Identity->get('id') && !$user->owner):?>
                                <?= $this->Html->link(($user->active?'disable':'enable'), ['action' => ($user->active?'disable':'enable').'User', $user->id],['confirm' => 'Are you sure('.($user->active?'disable':'enable').')?']) ?>
                                <?= $this->Html->link('Edit', ['action' => 'editUser', $user->id]) ?>
                                <?= $this->Html->link('Delete', ['action' => 'deleteUser', $user->id],['confirm' => 'Are you sure?']) ?>
                            <?php endif;?>
                        <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                   
                    <tfooter>
                        <tr>
                            <td colspan="6" style="border:0" ds=""> 
                                <h1 class="text-right">
                                    <?= $this->Html->link('Add User', ['action' => 'addUser']) ?>
                                </h1>   
                            </td>
                        </tr>
                    <tfooter>
                </table>
               
            </div>
            
        </div>
    </div>
</section>