<?php 
  require_once __DIR__ . '/../layout/header-admin.php'; 
?>

<div class="flex flex-grow overflow-hidden">
    
    <aside id="sidebar" class="bg-gray-900 text-gray-400 w-64 transition-all duration-300 ease-in-out flex flex-col border-r border-gray-700 shrink-0">
        <div class="p-4 border-b border-gray-800 flex justify-between items-center">
            <span id="sidebar-title" class="text-[10px] font-black uppercase tracking-widest text-gray-500">Navegación</span>
            <button onclick="toggleSidebar()" class="text-white hover:bg-gray-800 p-1 transition-colors">
                <span id="toggle-icon">◂</span>
            </button>
        </div>

        <nav class="flex-grow py-4">
            <ul class="space-y-1">
                <li>
                    <a href="#" class="flex items-center gap-4 px-6 py-3 text-white bg-gray-800 border-r-4 border-blue-500">
                        <span class="text-lg">📊</span>
                        <span class="menu-text text-[11px] font-bold uppercase tracking-wider">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-4 px-6 py-3 hover:bg-gray-800 hover:text-white transition group">
                        <span class="text-lg">🎓</span>
                        <span class="menu-text text-[11px] font-bold uppercase tracking-wider">Alumnos</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo URL_PROJECT;?>index.php?url=multas/store" class="flex items-center gap-4 px-6 py-3 hover:bg-gray-800 hover:text-white transition group">
                        <span class="text-lg">🚫</span>
                        <span class="menu-text text-[11px] font-bold uppercase tracking-wider">Catálogo Faltas</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-4 px-6 py-3 hover:bg-gray-800 hover:text-white transition group">
                        <span class="text-lg">📁</span>
                        <span class="menu-text text-[11px] font-bold uppercase tracking-wider">Reportes PDF</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="flex-grow bg-gray-50 overflow-y-auto">
        
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <span class="w-2 h-6 bg-gray-800 inline-block"></span>
                SISTEMA DE CONTROL DISCIPLINARIO | PANEL ADMINISTRATIVO
            </h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 text-slate-700">
                <div class="bg-slate-100 border border-slate-200 p-4 rounded-none shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Total Usuarios</p>
                    <p class="text-3xl font-light">1,240</p>
                </div>
                <div class="bg-blue-50 border border-blue-100 p-4 rounded-none shadow-sm text-blue-900">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Sanciones Activas</p>
                    <p class="text-3xl font-light">42</p>
                </div>
                <div class="bg-stone-100 border border-stone-200 p-4 rounded-none shadow-sm text-stone-800">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Reportes Semanales</p>
                    <p class="text-3xl font-light">18</p>
                </div>
                <div class="bg-teal-50 border border-teal-100 p-4 rounded-none shadow-sm text-teal-900">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Horas Liberadas</p>
                    <p class="text-3xl font-light">310</p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                
                <div class="w-full lg:w-96 flex-shrink-0">
                    <div class="bg-white border border-gray-300 rounded-none shadow-sm">
                        <div class="bg-gray-800 text-white px-4 py-2 text-[10px] font-bold uppercase tracking-wider">
                            Nuevo Registro de Sanción
                        </div>
                        <form action="<?php echo URL_PROJECT; ?>index.php?url=sanciones/store" method="POST" class="p-5 space-y-4">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">ID Alumno / Matrícula</label>
                                <input type="text" name="matricula" required class="w-full p-2 text-sm border border-gray-300 rounded-none bg-gray-50 focus:bg-white focus:border-gray-800 outline-none">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Código de Infracción</label>
                                <select name="codigo_falta_id" required class="w-full p-2 text-sm border border-gray-300 rounded-none bg-gray-50 focus:bg-white focus:border-gray-800 outline-none cursor-pointer">
                                    <option value="">-- Seleccionar Falta --</option>
                                    <option value="1">C01 - Uso de equipo no autorizado</option>
                                    <option value="2">C02 - Comportamiento disruptivo</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Evidencia / Notas</label>
                                <textarea name="observaciones" rows="4" class="w-full p-2 text-sm border border-gray-300 rounded-none bg-gray-50 focus:bg-white focus:border-gray-800 outline-none resize-none"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-gray-800 hover:bg-black text-white text-[10px] font-bold py-3 rounded-none transition uppercase tracking-widest">
                                Ejecutar Registro
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex-grow">
                    <div class="bg-white border border-gray-300 rounded-none shadow-sm overflow-hidden">
                        <div class="bg-gray-50 px-4 py-2 border-b border-gray-200 flex justify-between items-center">
                            <span class="text-[10px] font-bold text-gray-600 uppercase">Bitácora Global de Sanciones</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-[11px] border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 border-b border-gray-300">
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">Ref.</th>
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">Matrícula</th>
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">Estudiante</th>
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">Código</th>
                                        <th class="p-4 font-bold uppercase">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-gray-700">
                                    <tr class="hover:bg-blue-50/30 transition-colors">
                                        <td class="p-4 text-gray-400 border-r border-gray-100">#0812</td>
                                        <td class="p-4 font-mono border-r border-gray-100">MDEO220054</td>
                                        <td class="p-4 font-bold border-r border-gray-100">MILLAN, ETHAN</td>
                                        <td class="p-4 border-r border-gray-100">C01 - Uso de equipo</td>
                                        <td class="p-4">
                                            <span class="border border-amber-300 text-amber-700 bg-amber-50 px-2 py-1 text-[9px] font-black uppercase">Pendiente</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const menuTexts = document.querySelectorAll('.menu-text');
        const title = document.getElementById('sidebar-title');
        const icon = document.getElementById('toggle-icon');

        if (sidebar.classList.contains('w-64')) {
            sidebar.classList.replace('w-64', 'w-20');
            menuTexts.forEach(el => el.classList.add('hidden'));
            title.classList.add('hidden');
            icon.innerText = '▸';
        } else {
            sidebar.classList.replace('w-20', 'w-64');
            setTimeout(() => {
                menuTexts.forEach(el => el.classList.remove('hidden'));
                title.classList.remove('hidden');
            }, 150);
            icon.innerText = '◂';
        }
    }
</script>

<?php 
  require_once __DIR__ . '/../layout/footer.php'; 
?>