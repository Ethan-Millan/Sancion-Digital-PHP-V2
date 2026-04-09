<?php 
  require_once __DIR__ . '/../../layout/header-admin.php'; 
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
                    <a href="<?php echo URL_PROJECT; ?>index.php?url=admin/dashboard" class="flex items-center gap-4 px-6 py-3 hover:bg-gray-800 hover:text-white transition group">
                        <span class="text-lg">📊</span>
                        <span class="menu-text text-[11px] font-bold uppercase tracking-wider">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-4 px-6 py-3 text-white bg-gray-800 border-r-4 border-blue-500">
                        <span class="text-lg">🚫</span>
                        <span class="menu-text text-[11px] font-bold uppercase tracking-wider">Catálogo Faltas</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-4 px-6 py-3 hover:bg-gray-800 hover:text-white transition group">
                        <span class="text-lg">🎓</span>
                        <span class="menu-text text-[11px] font-bold uppercase tracking-wider">Alumnos</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="flex-grow bg-gray-50 overflow-y-auto">
        
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <span class="w-2 h-6 bg-gray-800 inline-block"></span>
                CATÁLOGO DE CÓDIGOS DE FALTAS
            </h1>
        </div>

        <div class="p-6">
            <div class="flex flex-col lg:flex-row gap-6">
                
                <div class="w-full lg:w-80 flex-shrink-0">
                    <div class="bg-white border border-gray-300 rounded-none shadow-sm">
                        <div class="bg-gray-800 text-white px-4 py-2 text-[10px] font-bold uppercase tracking-wider">
                            Registrar Nuevo Código
                        </div>
                        <form action="<?php echo URL_PROJECT; ?>index.php?url=multas/store" method="POST" class="p-5 space-y-4">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Nombre de la Falta</label>
                                <input type="text" name="nombre_falta" placeholder="Ej: Uso de celular" required 
                                       class="w-full p-2 text-sm border border-gray-300 rounded-none bg-gray-50 focus:bg-white focus:border-gray-800 outline-none">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Horas de Sanción</label>
                                <input type="number" name="horas_sancion" min="1" value="1" required 
                                       class="w-full p-2 text-sm border border-gray-300 rounded-none bg-gray-50 focus:bg-white focus:border-gray-800 outline-none">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Descripción</label>
                                <textarea name="descripcion" rows="4" placeholder="Detalles de la infracción..."
                                          class="w-full p-2 text-sm border border-gray-300 rounded-none bg-gray-50 focus:bg-white focus:border-gray-800 outline-none resize-none"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-gray-800 hover:bg-black text-white text-[10px] font-bold py-3 rounded-none transition uppercase tracking-widest">
                                Guardar en Catálogo
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex-grow">
                    <div class="bg-white border border-gray-300 rounded-none shadow-sm overflow-hidden">
                        <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                            <span class="text-[10px] font-bold text-gray-600 uppercase">Códigos Registrados en el Sistema</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-[11px] border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 border-b border-gray-300">
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">ID</th>
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">Nombre de Falta</th>
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">Descripción</th>
                                        <th class="p-4 font-bold uppercase border-r border-gray-200">Horas</th>
                                        <th class="p-4 font-bold uppercase text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-gray-700">
                                    <tr class="hover:bg-blue-50/30 transition-colors">
                                        <td class="p-4 text-gray-400 border-r border-gray-100 font-mono">1</td>
                                        <td class="p-4 font-bold border-r border-gray-100 uppercase">Uso de equipo no autorizado</td>
                                        <td class="p-4 border-r border-gray-100 text-gray-500">Utilizar computadoras del laboratorio fuera de horario o para fines ajenos.</td>
                                        <td class="p-4 border-r border-gray-100 font-bold text-center">
                                            <span class="bg-blue-50 text-blue-700 px-2 py-1 border border-blue-200">2 HRS</span>
                                        </td>
                                        <td class="p-4 text-center space-x-2">
                                            <button class="text-blue-600 hover:text-blue-800 font-bold uppercase text-[9px]">Editar</button>
                                            <button class="text-red-600 hover:text-red-800 font-bold uppercase text-[9px]">Eliminar</button>
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
  require_once __DIR__ . '/../../layout/footer.php'; 
?>