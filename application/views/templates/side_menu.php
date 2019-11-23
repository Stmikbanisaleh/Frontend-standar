<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu" data-plugin="menu">
          <li class="site-menu-category">Menu</li>
          <li class="site-menu-item">
            <a href="<?= base_url('dashboard'); ?>">
              <i class="site-menu-icon fa-tachometer" aria-hidden="true"></i>
              <span class="site-menu-title">Dashboard</span>
            </a>
          </li>
          <?php
          $roleid = $user['ROLE_ID'];
          if ($roleid == 96) {
            include('menu_pengusul.php');
            include('menu_sekretariat.php');
          }
          ?>

          <?php
          $roleid = $user['ROLE_ID'];
          if ($roleid == 97) {
            include('menu_pengusul.php');
          }
          ?>

          <?php
          $roleid = $user['ROLE_ID'];
          if ($roleid == 98) {
            include('menu_sekretariat.php');
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="site-menubar-footer">
  </div>
</div>