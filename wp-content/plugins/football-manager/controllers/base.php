<?php
class Base
{
    protected $offset;

    public function checkAllow()
    {
        if (!current_user_can( 'manage_options' )) {
            wp_die( __('You do not have sufficient permission to access this page.') );
        }
    }

    public function getAdminUrl($link)
    {
        return admin_url('admin.php?page='.$link);
    }

    public function getActionUrl($action, $id)
    {
        return admin_url('admin.php?page='.static::LINK_INDEX.'&action='.$action.'&id='.$id);
    }

    public function getPagination($total, $limit = 10)
    {
        $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
        $this->offset = ( $pagenum - 1 ) * $limit;
        $num_of_pages = ceil( $total / $limit );

        $page_links = paginate_links( array(
            'base' => add_query_arg( 'pagenum', '%#%' ),
            'format' => '',
            'prev_text' => __( '&laquo;', 'text-domain' ),
            'next_text' => __( '&raquo;', 'text-domain' ),
            'total' => $num_of_pages,
            'current' => $pagenum
        ) );

        return $page_links;
    }

    public function renderColumnSortable($columnName, $state = 'sortable')
    {
        $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';
        $linkOrder = $currentOrder == 'asc' ? 'desc' : 'asc';
        //$state = isset($_GET['order']) && $_GET['orderby'] == $columnName ? 'sorted' : 'sortable';

        echo '
<th class="'.$state.' '.$currentOrder.'">
    <a href="' . $this->getAdminUrl( static::LINK_INDEX . '&orderby='.$columnName.'&order='.$linkOrder.'' ) . '">
        <span>Date</span>
        <span class="sorting-indicator"></span>
    </a>
</th>';
    }
}