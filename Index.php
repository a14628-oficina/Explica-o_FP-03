<?php
/**
 * Dashboard | Rede Escolar
 * Versão Melhorada - Com botão de conta
 */

// Exemplo de dados para as estatísticas (Substitua pela sua lógica de base de dados se necessário)
$stats = [
    ["Salas", "12", "bg-blue-600"],
    ["Equipamentos", "48", "bg-green-600"],
    ["Técnicos", "5", "bg-purple-600"],
    ["Intervenções", "3", "bg-orange-600"]
];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Rede Escolar</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        .sidebar-active { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; }
        .stat-card { transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .module-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .module-card:hover { transform: translateY(-6px); box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12); }
    </style>
</head>
<body class="text-gray-800">

<div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-gray-100 flex flex-col shadow-2xl fixed h-screen z-50">
        <div class="px-6 py-8 border-b border-gray-700">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-xl">🎓</div>
                <div>
                    <h1 class="text-xl font-bold">Rede Escolar</h1>
                    <p class="text-xs text-gray-400">Gestão de Infraestrutura</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="index.php" class="sidebar-active flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-blue-400">
                <i class="fas fa-chart-line w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="salas_tecnicos.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                <i class="fas fa-building w-5"></i>
                <span>Salas & Técnicos</span>
            </a>
            <a href="equipamentos.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                <i class="fas fa-laptop w-5"></i>
                <span>Equipamentos</span>
            </a>
            <a href="intervencoes.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                <i class="fas fa-wrench w-5"></i>
                <span>Intervenções</span>
            </a>
        </nav>

        <div class="px-6 py-4 border-t border-gray-700 text-xs text-gray-500">
            <p>© 2026 Rede Escolar</p>
            <p>v1.0.2 - Estável</p>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 ml-64 p-8 bg-gray-50">

        <!-- HEADER -->
        <header class="mb-10 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Dashboard</h1>
                <p class="text-gray-500 mt-2 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    Visão geral completa da infraestrutura escolar
                </p>
            </div>

            <div class="flex items-center gap-6">
                <!-- Última atualização -->
                <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200 text-right">
                    <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Última atualização</p>
                    <p class="text-lg font-mono font-bold text-blue-600" id="current-time">--:--:--</p>
                </div>

                <!-- MENU DE UTILIZADOR -->
                <div class="relative" id="userMenu">
                    <button class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition">
                        <i class="fa-solid fa-user"></i>
                        Conta
                    </button>

                    <div id="userDropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden z-50">

                        <a href="alterar_senha.php"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            Alterar Senha
                        </a>

                        <a href="logout.php"
                        class="block px-4 py-2 text-red-600 hover:bg-red-100 transition">
                            Terminar Sessão
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- STATISTICS SECTION -->
        <section class="mb-12">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                Estatísticas Gerais
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($stats as $s): ?>
                <div class="stat-card bg-white rounded-2xl shadow-sm p-6 border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider"><?= $s[0] ?></p>
                            <p class="text-4xl font-black text-gray-900 mt-2"><?= $s[1] ?></p>
                        </div>
                        <div class="h-14 w-14 rounded-2xl <?= $s[2] ?> flex items-center justify-center text-white text-2xl shadow-lg shadow-blue-100">
                            <?php
                            switch($s[0]) {
                                case "Salas": echo '<i class="fas fa-building"></i>'; break;
                                case "Equipamentos": echo '<i class="fas fa-laptop"></i>'; break;
                                case "Técnicos": echo '<i class="fas fa-user-tie"></i>'; break;
                                case "Intervenções": echo '<i class="fas fa-tools"></i>'; break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- MODULES SECTION -->
        <section>
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-green-500 rounded-full"></span>
                Módulos do Sistema
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <!-- Module 1 -->
                <a href="salas_tecnicos.php" class="module-card group bg-white rounded-2xl shadow-sm p-8 border border-gray-100 hover:border-blue-200">
                    <div class="h-14 w-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-3">Salas & Técnicos</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Gestão centralizada de espaços físicos e equipa técnica especializada.</p>
                    <div class="flex items-center gap-2 text-blue-600 font-bold text-sm">
                        <span>Aceder ao Módulo</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </a>

                <!-- Module 2 -->
                <a href="equipamentos.php" class="module-card group bg-white rounded-2xl shadow-sm p-8 border border-gray-100 hover:border-green-200">
                    <div class="h-14 w-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-3">Equipamentos</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Inventário detalhado e monitorização do estado operacional de todo o hardware.</p>
                    <div class="flex items-center gap-2 text-green-600 font-bold text-sm">
                        <span>Aceder ao Módulo</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </a>

                <!-- Module 3 -->
                <a href="intervencoes.php" class="module-card group bg-white rounded-2xl shadow-sm p-8 border border-gray-100 hover:border-red-200">
                    <div class="h-14 w-14 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-3">Intervenções</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Histórico completo de manutenções e registo de novas ocorrências técnicas.</p>
                    <div class="flex items-center gap-2 text-red-600 font-bold text-sm">
                        <span>Aceder ao Módulo</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </a>

            </div>
        </section>

        <!-- QUICK ACTIONS -->
        <section class="mt-12 bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Ações Rápidas</h3>
                    <p class="text-sm text-gray-500">Ferramentas de gestão imediata</p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <button class="px-6 py-3 bg-gray-900 text-white rounded-xl font-bold text-sm hover:bg-gray-800 transition flex items-center gap-2">
                        <i class="fas fa-file-export"></i> Exportar PDF
                    </button>
                    <button class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition flex items-center gap-2">
                        <i class="fas fa-sync"></i> Atualizar Dados
                    </button>
                </div>
            </div>
        </section>

    </main>
</div>

<!-- Atualização do relógio -->
<script>
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleTimeString('pt-PT');
    }
    updateTime();
    setInterval(updateTime, 1000);
</script>

<!-- Dropdown da Conta -->
<script>
document.getElementById("userMenu").addEventListener("click", function() {
    const menu = document.getElementById("userDropdown");
    menu.classList.toggle("hidden");
});

window.addEventListener("click", function(e) {
    if (!e.target.closest("#userMenu")) {
        document.getElementById("userDropdown").classList.add("hidden");
    }
});
</script>

</body>
</html>
