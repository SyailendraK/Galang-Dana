<div class="navbar-fixed">
  <nav class="z-depth-0 bottom container bottom-nav amber darken-4">
    <div class="nav-wrapper">
      <div class="nav-content">
        <ul class="tabs tabs-transparent">
          <li class="tab">
            <a href="/home"
              ><i class="material-icons large">home</i
              ><span class="float">Home</span></a
            >
          </li>
          <li class="tab">
            <a href="/donasi"
              ><i class="material-icons large">face</i
              ><span class="float">Donasi</span></a
            >
          </li>
          <li class="tab">
            <a href="/informasi"
              ><i class="material-icons large">info</i
              ><span class="float">Informasi</span></a
            >
          </li>
        <?php if(!logged_in()): ?>
          <li class="tab">
            <a href="/login"
              ><i class="material-icons large">account_circle</i
              ><span class="float">Login</span></a
            >
          </li>
        <?php else: ?>
        <?php if(in_groups('admin') || in_groups('super')): ?>
          <li class="tab">
            <a href="/dashboardAdmin"
              ><i class="material-icons large">account_circle</i
              ><span class="float">Dashboard</span></a
            >
          </li>
        <?php else: ?>
          <li class="tab">
            <a href="/dashboard"
              ><i class="material-icons large">account_circle</i
              ><span class="float">Dashboard</span></a
            >
          </li>
        <?php endif; ?>
          
          <li class="tab">
            <a href="/logout"
              ><i class="material-icons large">input</i
              ><span class="float">Logout</span></a
            >
          </li>
        <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</div>
<div class="eye"><i class="material-icons small">remove_red_eye</i></div>

<!-- data-target="modal-login" modal-trigger -->
