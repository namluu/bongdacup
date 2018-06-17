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
    <h1 class="wp-heading-inline">Football Matches</h1>
    <a href="<?php echo $this->getAdminUrl( self::LINK_NEW ); ?>" class="page-title-action">Add New</a>
    <div class="tablenav top">
        <form id="posts-filter" method="get">
            <input type="hidden" name="page" value="football-manager-match">
            <div class="alignleft actions">
                <select name="league" id="league" class="postform">
                    <option value="0">All Leagues</option>
                    <?php foreach ($leagues as $league): ?>
                        <?php $selected = ($league->id == $_GET['league'] ? 'selected="selected"' : '') ?>
                        <option value="<?php echo $league->id ?>" <?php echo $selected ?>><?php echo $league->name ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">
            </div>
            <div class="tablenav-pages one-page">
                <div class="displaying-num"><?php echo sizeof($matches) . ' item' ?></div>
            </div>
        </form>
    </div>
    
    <!-- using admin_action_ . $_REQUEST['action'] hook in admin.php -->
    <table class="wp-list-table widefat fixed striped posts">
        <thead>
            <tr>
                <?php echo $this->renderColumnSortable('match_date', 'sorted') ?>
                <th>Name</th>
                <th>Link URL</th>
                <th width="40">Active</th>
                <th width="40">Order</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="the-list">
        <?php if (isset($matches)): ?>
            <?php foreach($matches as $match): ?>
            <tr>
                <td><?php echo $match->match_date ?></td>
                <td><?php echo $match->name ?></th>
                <td><a href="<?php echo site_url('tran-dau/'. $match->url) ?>"><?php echo $match->url ?></a></td>
                <td>
                    <?php if ($match->is_active): ?>
                        <a href="<?php echo $this->getActionUrl('inactive', $match->id ); ?>">
                            <img src="<?php echo esc_url( admin_url( 'images/yes.png' ) ); ?>" alt="" />
                        </a>
                    <?php else: ?>
                        <a href="<?php echo $this->getActionUrl('active', $match->id ); ?>">
                            <img src="<?php echo esc_url( admin_url( 'images/no.png' ) ); ?>" alt="" />
                        </a>
                    <?php endif; ?>
                </td>
                <td><?php echo $match->ordering ?></td>
                <td>
                    <a href="<?php echo $this->getAdminUrl( self::LINK_EDIT . '&id='. $match->id ); ?>">Edit</a> | 
                    <a href="<?php echo $this->getActionUrl('delete', $match->id ); ?>" onclick="return confirm('Want to delete?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div> <!-- end div.wrap -->