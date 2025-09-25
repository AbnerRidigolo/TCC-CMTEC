<?php
session_start();
include '../../../Controller/conexao.php'; 
// Verifica se o token da sessão está presente
if (!isset($_SESSION['token'])) {
    header('Location: ../../login.html');
    exit;
}
// Divide o token em sua parte principal e tipo (admin ou aluno)
list($token, $type) = explode('_', $_SESSION['token'], 2);

// Verifica se o tipo do token é 'admin'
if ($type !== 'admin') {
    header('Location: ../../login.html');
    exit;
}

$sql = "SELECT codAluno, nome, email FROM Aluno";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT codChamado FROM Chamado";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$chamados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CMTEC - ADMIN</title>
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between" >
          <a href="index.php" class="text-nowrap logo-img" >
            <h2>CMTEC ADMIN</h2>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php" aria-expanded="false">
                <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Componentes</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="chamados.php" aria-expanded="false">
                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                <span class="hide-menu">Chamados</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="usuarios.php" aria-expanded="false">
                <iconify-icon icon="solar:danger-circle-line-duotone"></iconify-icon>
                <span class="hide-menu">Usuarios</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="ambientes.php" aria-expanded="false">
                <iconify-icon icon="solar:bookmark-square-minimalistic-line-duotone"></iconify-icon>
                <span class="hide-menu">Ambientes</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="estatisticas.php" aria-expanded="false">
                <iconify-icon icon="solar:file-text-line-duotone"></iconify-icon>
                <span class="hide-menu">Estatisticas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="FAQ.php" aria-expanded="false">
                <iconify-icon icon="solar:text-field-focus-line-duotone"></iconify-icon>
                <span class="hide-menu">FAQs</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>           
            <li class="sidebar-item">
              <a class="sidebar-link" href="../../deslogar.php" aria-expanded="false">
                <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Sair</span>
              </a>
            </li>         
                    
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Meu perfil</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Mensagens</p>
                    </a>
                    <a href="../../deslogar.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Sair</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          <div class="row">
            <div class="col-lg-8 d-flex align-items-strech">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Chamados por mes</h5>
                    </div>
                    <div>
                      <select class="form-select">
                        <option value="1">March 2024</option>
                        <option value="2">April 2024</option>
                        <option value="3">May 2024</option>
                        <option value="4">June 2024</option>
                      </select>
                    </div>
                  </div>
                  <div id="sales-profit"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card bg-danger-subtle shadow-none w-100">
                    <div class="card-body">
                      <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-6">
                          <div
                            class="rounded-circle-shape bg-danger px-3 py-2 rounded-pill d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:users-group-rounded-bold-duotone"
                              class="fs-7 text-white"></iconify-icon>
                          </div>
                          <h6 class="mb-0 fs-4 fw-medium text-muted">
                            Total Usuarios
                          </h6>
                        </div>
                      </div>
                      <div class="row align-items-end justify-content-between">
                        <div class="col-5">
                          <h2 class="mb-6 fs-8"><?php echo count($alunos); ?></h2>
                        </div>
                        <div class="col-5">
                          <div id="total-followers" class="rounded-bars"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="card bg-secondary-subtle shadow-none w-100">
                    <div class="card-body">
                      <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-6">
                          <div
                            class="rounded-circle-shape bg-secondary px-3 py-2 rounded-pill d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:wallet-2-line-duotone" class="fs-7 text-white"></iconify-icon>
                          </div>
                          <h6 class="mb-0 fs-4 fw-medium text-muted">
                            Total Chamados
                          </h6>
                        </div>
                      </div>
                      <div class="row align-items-center justify-content-between pt-4">
                        <div class="col-5">
                          <h2 class="mb-6 fs-8 text-nowrap"><?php echo count($chamados); ?></h2>
                        </div>
                        <div class="col-5">
                          <div id="total-income"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
          <div class="row">
  <div class="col-lg-4">
    <div class="card overflow-hidden hover-img" style="border: none; margin: 0; padding: 0;">
      <a href="chamados.php" style="display: block; text-decoration: none; color: inherit;">
        <div class="position-relative">
          <img src="../assets/images/blog/blog-img1.jpg" class="card-img-top" alt="materialM-img" style="width: 100%; height: auto;">
        </div>
        <div class="card-body p-4" style="text-align: center;">
          <p class="d-block my-4 fs-5 text-dark fw-semibold link-primary" style="margin: 0; color: inherit;">Chamados</p>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card overflow-hidden hover-img" style="border: none; margin: 0; padding: 0;">
      <a href="usuarios.php" style="display: block; text-decoration: none; color: inherit;">
        <div class="position-relative">
          <img src="../assets/images/blog/blog-img1.jpg" class="card-img-top" alt="materialM-img" style="width: 100%; height: auto;">
        </div>
        <div class="card-body p-4" style="text-align: center;">
          <p class="d-block my-4 fs-5 text-dark fw-semibold link-primary" style="margin: 0; color: inherit;">Usuarios</p>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card overflow-hidden hover-img" style="border: none; margin: 0; padding: 0;">
      <a href="ambientes.php" style="display: block; text-decoration: none; color: inherit;">
        <div class="position-relative">
          <img src="../assets/images/escada.jpg" class="card-img-top" alt="materialM-img" style="width: 100%; height: auto;">
        </div>
        <div class="card-body p-4" style="text-align: center;">
          <p class="d-block my-4 fs-5 text-dark fw-semibold link-primary" style="margin: 0; color: inherit;">Ambientes</p>
        </div>
      </a>
    </div>
  </div>
</div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>