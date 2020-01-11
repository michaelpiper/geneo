<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <br/>
            <h1>Profile</h1>
            <div class="mx-5">
                <table>
                    <tbody>
                        <!-- <tr>
                            <th></th>
                            <td><?=$user->email?></td>
                        </tr> -->
                        <tr>
                            <th>email</th>
                            <td><?=$user->email?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?=$user->username?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?=$user->admin?'Admin':'Author'?></td>
                        </tr>
                        <tr>
                            <th>Owner</th>
                            <td><?=$user->owner?'True':'False'?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><p><?=$user->description?></p></td>
                        </tr>
                    </tbody>
                </table>
                <!-- <?= $this->Html->link('Change password', ['action' => 'changeRole', $user->id],['confirm' => 'Are you sure change user role?']) ?> -->
                <?= $this->Html->link('Edit user', ['action' => 'editUser', $user->id],['confirm' => 'Are you sure edit user?']) ?>
              
            </div>
        </div>
    </div>
</section>