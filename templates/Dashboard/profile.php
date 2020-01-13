<section class="home-about-area pt-10">
    <div class=" wrapper d-flex align-items-stretch">
        <?php require __DIR__."/sidebar.inc.php"?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <br/>
            <h1>Profile</h1>
            <div class="mx-5">
            <?= $this->Flash->render() ?>
            <img class="img-fluid img-preview rounded-circle"  style="max-height:300px;height:300px;width:300px;" src="<?= ($this->Identity->get('display_image')) ? $this->Identity->get('display_image'):'/img/placeholder.png' ?>" alt="">
                <table>
                    <tbody>
                        <!-- <tr>
                            <th></th>
                            <td><?=$this->Identity->get('email')?></td>
                        </tr> -->
                        <tr>
                            <th>email</th>
                            <td><?=$this->Identity->get('email')?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?=$this->Identity->get('username')?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?=$this->Identity->get('admin')?'Admin':'Author'?></td>
                        </tr>
                        <tr>
                            <th>Owner</th>
                            <td><?=$this->Identity->get('owner')?'True':'False'?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><p><?=$this->Identity->get('description')?></p></td>
                        </tr>
                    </tbody>
                </table>
                <?= $this->Html->link('Change password', ['action' => 'changePassword'],['confirm' => 'Are you sure change your password?']) ?>
                <?= $this->Html->link('Edit profile', ['action' => 'editProfile'],['confirm' => 'Are you sure edit your profile?']) ?>
              
            </div>
        </div>
    </div>
</section>