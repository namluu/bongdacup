<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<div class="notice notice-success is-dismissible">
    <p>Saved successfully</p>
</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
<div class="notice notice-error is-dismissible">
    <p>Saved not successfully</p>
</div>
<?php endif; ?>

<?php settings_errors(); ?>

<div class="wrap">
    <h1>Football Leagues</h1>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="tablenav top">
                    <a href="<?php echo $this->getAdminUrl( self::LINK_NEW ); ?>" class="page-title-action">Add New</a>
                    <div class="tablenav-pages one-page">
                        <div class="displaying-num"><?php echo sizeof($leagues) . ' item' ?></div>
                    </div>
                </div>
                
                <!-- using admin_action_ . $_REQUEST['action'] hook in admin.php -->
                <table class="wp-list-table widefat fixed striped posts">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Link URL</th>
                            <th class="center">Link Image</th>
                            <th width="40">Active</th>
                            <th width="40">Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="the-list">
                    <?php if (isset($leagues)): ?>
                        <?php foreach($leagues as $league): ?>
                        <tr>
                            <td><?php echo $league->name ?></th>
                            <td><?php echo $league->url ?></td>
                            <td class="center"><img src="<?php echo $league->link_image ?>" height="50" /></td>
                            <td>
                                <?php if ($league->is_active): ?>
                                    <a href="<?php echo $this->getActionUrl('inactive', $league->id); ?>">
                                        <img src="<?php echo esc_url( admin_url( 'images/yes.png' ) ); ?>" alt="" />
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo $this->getActionUrl('active', $league->id ); ?>">
                                        <img src="<?php echo esc_url( admin_url( 'images/no.png' ) ); ?>" alt="" />
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $league->ordering ?></td>
                            <td>
                                <a href="<?php echo $this->getAdminUrl( self::LINK_EDIT . '&id='. $league->id ); ?>">Edit</a> |
                                <a href="<?php echo $this->getActionUrl('delete', $league->id ); ?>" onclick="return confirm('Want to delete?');">Delete</a>
                                
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div id="postbox-container-1" class="postbox-container">
                <div class="counter-meta">
                    <img src="<?php echo FM_PLUGIN_URL .  '/images/leagues.jpg' ; ?>" alt="icon" /> 
                </div>
            </div>
        </div>
    </div>
</div> <!-- end div.wrap -->