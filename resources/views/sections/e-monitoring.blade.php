<!-- E-Monitoring Section -->
<section class="py-24 bg-gray-100" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-2xl font-normal text-blue-sda tracking-widest">E-Monitoring</h2>
            <h3 class="text-3xl font-semibold text-blue-sda">BWS Sulawesi III Palu</h3>
        </div>
        
        <div class="bg-white rounded-lg p-6" style="border: 2px solid #f1d8a9;">
            @if($eMonitorings->count() > 0)
                @php
                    $totalRecord = $eMonitorings->where('kode', '1')->first();
                @endphp
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Last Updated: {{ $totalRecord && $totalRecord->last_updated ? $totalRecord->last_updated->format('d M Y, H:i:s') : now()->format('d M Y, H:i:s') }} WITA</p>
                    <h4 class="text-lg font-medium text-blue-sda">E-Monitoring</h4>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="rounded-lg" style="background-color: #f1d8a9;">
                                <th class="px-4 py-3 text-left text-sm font-medium text-blue-sda rounded-l-lg">KODE</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-blue-sda">SATUAN KERJA</th>
                                <th class="px-4 py-3 text-right text-sm font-medium text-blue-sda rounded-r-lg">REALISASI FISIK (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eMonitorings->where('kode', '!=', '1') as $monitoring)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-blue-sda">{{ $monitoring->kode }}</td>
                                <td class="px-4 py-3 text-sm text-blue-sda">{{ $monitoring->satuan_kerja }}</td>
                                <td class="px-4 py-3 text-sm text-blue-sda text-right">{{ number_format($monitoring->realisasi_fisik ?? 0, 2) }}</td>
                            </tr>
                            @endforeach
                            @if($totalRecord)
                            <tr class="bg-gray-100 font-medium">
                                <td class="px-4 py-3 text-sm text-blue-sda font-bold">Total BWS Sulawesi III Palu</td>
                                <td class="px-4 py-3 text-sm text-blue-sda"></td>
                                <td class="px-4 py-3 text-sm text-blue-sda text-right font-bold">{{ number_format($totalRecord->realisasi_fisik ?? 0, 2) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 text-sm">
                    <p class="text-yellow-600">Permintaan data, Kunjungi <a href="https://kaledo.bws-sulawesi3.com/" target="_blank" rel="noopener noreferrer" class="underline hover:text-yellow-700">Kaledo</a></p>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada data monitoring tersedia</p>
                </div>
            @endif
        </div>
    </div>
</section>