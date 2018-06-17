<div class="wrap">
    <h1><?php echo $title ?> <a href="<?php echo $this->getAdminUrl( self::LINK_INDEX ); ?>" class="page-title-action">Back</a></h1>

    <form name="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="action" value="fm_match_save_action" />
        <input type="hidden" name="id" value="<?php echo $row->id ?>" />
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-3">
                <table class="form-table">
                    <tr>
                        <th>Name</th>
                        <td>
                            <input class="regular-text" type="text" name="name" value="<?php echo $row->name ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <th>URL</th>
                        <td>
                            <input class="regular-text" type="text" name="url" id="url" value="<?php echo $row->url ?>" readonly="true">
                            Auto <input type="checkbox" name="auto_url" checked="checked" id="auto_url">
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>
                            <textarea name="description" rows="15" class="large-text"><?php echo $row->description ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>League</th>
                        <td>
                            <select name="league_id" class="regular-text selectpicker" data-live-search="true">
                                <option value="0">--- Select ---</option>
                                <?php foreach ($row->list_league as $league): ?>
                                    <?php $selected = ($league->id == $row->league_id ? 'selected="selected"' : '') ?>
                                    <option value="<?php echo $league->id ?>" <?php echo $selected ?> ><?php echo $league->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Active</th>
                        <td>
                            <select name="is_active">
                                <option value="1" <?php echo $row->is_active == 1 ? 'selected="selected"' : '' ?>>Active</option>
                                <option value="0" <?php echo $row->is_active == 0 ? 'selected="selected"' : '' ?>>Disable</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Home Team</th>
                        <td>
                            <select name="home_team_id" class="regular-text selectpicker" data-live-search="true">
                                <option value="0">--- Select ---</option>
                                <?php foreach ($row->list_team as $team): ?>
                                    <?php $selected = ($team->id == $row->home_team_id ? 'selected="selected"' : '') ?>
                                    <option value="<?php echo $team->id ?>" <?php echo $selected ?> ><?php echo $team->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Away Team</th>
                        <td>
                            <select name="away_team_id" class="regular-text selectpicker" data-live-search="true">
                                <option value="0">--- Select ---</option>
                                <?php foreach ($row->list_team as $team): ?>
                                    <?php $selected = ($team->id == $row->away_team_id ? 'selected="selected"' : '') ?>
                                    <option value="<?php echo $team->id ?>" <?php echo $selected ?> ><?php echo $team->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Match date</th>
                        <td>
                            <div class='input-group date regular-text' id='datetimepicker1'>
                                <input type='text' class="form-control" name="match_date" value="<?php echo $row->match_date ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <script type="text/javascript">
                                jQuery(function ($) {
                                    $('#datetimepicker1').datetimepicker({
                                        format : 'YYYY-MM-DD HH:mm'
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                </table>

                <p class="submit">
                    <input id="save" class="button button-primary" type="submit" value="Save" name="save" />
                    <input id="cancel" class="button" type="submit" value="Cancel" name="cancel" />
                </p>
            </div>
        </div>
    </form>
</div>