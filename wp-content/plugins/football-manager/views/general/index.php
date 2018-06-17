<div class="wrap">
    <h1>Football Manager</h1>
    <div class="welcome-panel">
        <div class="welcome-panel-content">
            <h2>Quản lý bóng đá</h2>
            <p class="about-description">Chúng tôi đã tập hợp sẵn một số liên kết để bạn có thể bắt đầu ngay:</p>
            <div class="welcome-panel-column-container">
                <div class="welcome-panel-column">
                    <h3>Hãy Bắt Đầu</h3>
                    <a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo $this->getAdminUrl( Match::LINK_NEW ); ?>">Thêm trận đấu</a>
                    <p class="hide-if-no-customize"><a href="<?php echo $this->getAdminUrl( Match::LINK_INDEX ); ?>">Quản lý danh sách trận đấu</a></p>
                </div>
                <div class="welcome-panel-column">
                    <h3>Giải đấu bóng đá</h3>
                    <ul>
                        <li><a href="<?php echo $this->getAdminUrl( League::LINK_INDEX ); ?>" class="welcome-icon welcome-edit-page">Quản lý giải đấu</a></li>
                        <li><a href="<?php echo $this->getAdminUrl( League::LINK_NEW ); ?>" class="welcome-icon welcome-add-page">Thêm giải đấu mới</a></li>
                    </ul>
                </div>
                <div class="welcome-panel-column welcome-panel-last">
                    <h3>Đội bóng</h3>
                    <ul>
                        <li><a href="<?php echo $this->getAdminUrl( Club::LINK_INDEX ); ?>" class="welcome-icon welcome-edit-page">Quản lý đội bóng</a></li>
                        <li><a href="<?php echo $this->getAdminUrl( Club::LINK_NEW ); ?>" class="welcome-icon welcome-add-page">Thêm đội bóng mới</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>