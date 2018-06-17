<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<div class="notice notice-success is-dismissible">
    <p>Saved successfully</p>
</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
<div class="notice notice-error is-dismissible">
    <p>Saved not successfully</p>
</div>
<?php endif; ?>

<div class="wrap">
    <h1>API live football</h1>
    <div class="counter-meta">
        <img src="<?php echo FM_PLUGIN_URL .  '/images/api.jpg' ; ?>" alt="icon" /> 
    </div>
    
    <!-- using admin_action_ . $_REQUEST['action'] hook in admin.php -->
    <div>https://sportstream365.com/</div>

    <form name="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="action" value="fm_live_save_action" />

        <table class="form-table">
            <tr>
                <th>Type</th>
                <td>
                    <fieldset>
                        <label><input type="radio" name="type" value="1" <?php echo $type == 1 ? 'checked="checked"' : '' ?>> <span class="format-i18n">1</span>
                        </label><br>
                        <label><input type="radio" name="type" value="2" <?php echo $type == 2 ? 'checked="checked"' : '' ?>> <span class="format-i18n">2</span>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th>Ẩn link bản quyền</th>
                <td>
                    <textarea name="hide_linklive" rows="5" class="large-text"><?php echo $hide_linklive ?></textarea>
                    <small>gồm IDs các trận đấu link auto live, phân cách bời dấu phẩy, ví dụ: 1336928,1336925</small>
                </td>
            </tr>
        </table>

        <p class="submit">
            <input id="save" class="button button-primary" type="submit" value="Save" name="save" />
            <input id="cancel" class="button" type="submit" value="Cancel" name="cancel" />
        </p>
    </form>
</div> <!-- end div.wrap -->