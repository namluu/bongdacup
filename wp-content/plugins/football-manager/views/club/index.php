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
    <h1 class="wp-heading-inline">Football Clubs</h1>
    <a href="<?php echo $this->getAdminUrl( self::LINK_NEW ); ?>" class="page-title-action">Add New</a>

    <div class="tablenav top">
        <form id="posts-filter" method="get">
            <input type="hidden" name="page" value="football-manager-club">
            <div class="alignleft actions">
                <?php $search = isset($_GET['name']) ? $_GET['name'] : '' ?>
                <input type="text" name="name" class="postform" placeholder="Club name" value="<?php echo $search ?>">
                <select name="league" id="league" class="postform">
                    <option value="0">All Leagues</option>
                    <?php foreach ($leagues as $league): ?>
                        <?php $selected = isset($_GET['league']) && $_GET['league'] == $league->id ? 'selected="selected"' : '' ?>
                        <option value="<?php echo $league->id ?>" <?php echo $selected ?>><?php echo $league->name ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">
                <a href="<?php echo $this->getAdminUrl( self::LINK_INDEX ); ?>" class="button2">Reset</a>
            </div>
            <div class="tablenav-pages">
                <span class="displaying-num"><?php echo $total ? $total : sizeof($clubs) ?> item(s)</span>
                <?php if ( $page_links ) :?>
                    <span class="pagination-links"><?php echo $page_links ?></span>
                <?php endif; ?>
                <a href="<?php echo $this->getAdminUrl( self::LINK_INDEX . '&view-all' ); ?>" class="button2">View All</a>
            </div>
        </form>
    </div>
    
    <!-- using admin_action_ . $_REQUEST['action'] hook in admin.php -->
    <table class="wp-list-table widefat fixed striped posts">
        <thead>
            <tr>
                <th>Name</th>
                <?php if (!isset($_GET['league'])): ?>
                <th>League</th>
                <?php endif ?>
                <th class="center">Link Image</th>
                <th width="40">Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="the-list">
        <?php if (isset($clubs)): ?>
            <?php foreach($clubs as $club): ?>
            <tr>
                <td><?php echo $club->name ?></td>
                <?php if (!isset($_GET['league'])): ?>
                <td><?php echo $club->league_name ?></td>
                <?php endif ?>
                <td class="center"><img src="<?php echo $club->link_image ?>" height="50" /></td>
                <td>
                    <?php if ($club->is_active): ?>
                        <a href="<?php echo $this->getActionUrl('inactive', $club->id ); ?>">
                            <img src="<?php echo esc_url( admin_url( 'images/yes.png' ) ); ?>" alt="" />
                        </a>
                    <?php else: ?>
                        <a href="<?php echo $this->getActionUrl('active', $club->id ); ?>">
                            <img src="<?php echo esc_url( admin_url( 'images/no.png' ) ); ?>" alt="" />
                        </a>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo $this->getAdminUrl( self::LINK_EDIT . '&id='. $club->id ); ?>">Edit</a> | 
                    <a href="<?php echo $this->getActionUrl('delete', $club->id ); ?>" onclick="return confirm('Want to delete?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div> <!-- end div.wrap -->