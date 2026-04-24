import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/kendaraan_model.dart';

class KendaraanDetailScreen extends StatelessWidget {
  final KendaraanModel kendaraan;

  const KendaraanDetailScreen({super.key, required this.kendaraan});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF3F4F6),
      body: CustomScrollView(
        slivers: [
          _buildSliverAppBar(),
          SliverToBoxAdapter(
            child: Padding(
              padding: const EdgeInsets.all(20.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  _buildSectionHeader('Informasi Umum'),
                  _buildInfoCard([
                    _buildInfoRow('Pemilik', kendaraan.pemilik),
                    _buildInfoRow(
                      'Merk / Tipe',
                      '${kendaraan.merk ?? '-'} / ${kendaraan.type ?? '-'}',
                    ),
                    _buildInfoRow('Model', kendaraan.model),
                    _buildInfoRow('Tahun', kendaraan.tahun?.toString()),
                    _buildInfoRow('Warna', kendaraan.warna),
                    _buildInfoRow('Jenis Kendaraan', kendaraan.jenisKendaraan),
                  ]),
                  const SizedBox(height: 20),
                  _buildSectionHeader('Mesin & Rangka'),
                  _buildInfoCard([
                    _buildInfoRow('Silinder', kendaraan.silinder),
                    _buildInfoRow('No. Rangka', kendaraan.rangka),
                    _buildInfoRow('No. Mesin', kendaraan.mesin),
                  ]),
                  const SizedBox(height: 20),
                  if (kendaraan.stnk != null) ...[
                    _buildSectionHeader('Data STNK'),
                    _buildInfoCard([
                      _buildInfoRow('Pajak', kendaraan.stnk!['pajak']),
                      _buildInfoRow('Plat', kendaraan.stnk!['plat']),
                    ]),
                    const SizedBox(height: 20),
                  ],
                  if (kendaraan.kir != null) ...[
                    _buildSectionHeader('Data KIR'),
                    _buildInfoCard([
                      _buildInfoRow('No. KIR', kendaraan.kir!['no_kir']),
                      _buildInfoRow(
                        'Berlaku Sampai',
                        kendaraan.kir!['end_kir'],
                      ),
                    ]),
                    const SizedBox(height: 20),
                  ],
                  if (kendaraan.insurance != null) ...[
                    _buildSectionHeader('Data Asuransi'),
                    _buildInfoCard([
                      _buildInfoRow(
                        'No. Polis',
                        kendaraan.insurance!['no_polish'],
                      ),
                      _buildInfoRow(
                        'Nama Polish',
                        kendaraan.insurance!['name'],
                      ),
                      _buildInfoRow(
                        'Berlaku Sampai',
                        kendaraan.insurance!['end_insurance'],
                      ),
                      _buildInfoRow(
                        'Harga',
                        _formatCurrency(kendaraan.insurance!['harga']),
                      ),
                    ]),
                    const SizedBox(height: 20),
                  ],
                  const SizedBox(height: 40),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSliverAppBar() {
    return SliverAppBar(
      expandedHeight: 180.0,
      floating: false,
      pinned: true,
      backgroundColor: const Color(0xFF1E3A8A),
      elevation: 0,
      iconTheme: const IconThemeData(color: Colors.white),
      flexibleSpace: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            colors: [Color(0xFF1E3A8A), Color(0xFF3B82F6)],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
        ),
        child: FlexibleSpaceBar(
          centerTitle: true,
          title: Text(
            kendaraan.nopol ?? 'Detail Kendaraan',
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.bold,
              color: Colors.white,
              fontSize: 22,
            ),
          ),
          background: Stack(
            children: [
              Positioned(
                right: -50,
                top: -50,
                child: Container(
                  width: 200,
                  height: 200,
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    color: Colors.white.withOpacity(0.1),
                  ),
                ),
              ),
              Positioned(
                left: -30,
                bottom: -20,
                child: Container(
                  width: 140,
                  height: 140,
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    color: Colors.white.withOpacity(0.1),
                  ),
                ),
              ),
              Center(
                child: Icon(
                  Icons.directions_car,
                  size: 80,
                  color: Colors.white.withOpacity(0.3),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  String _formatCurrency(dynamic amount) {
    if (amount == null) return '-';
    String str = amount.toString().replaceAll(RegExp(r'[^0-9]'), '');
    if (str.isEmpty) return amount.toString();
    int value = int.parse(str);
    String result = value.toString().replaceAllMapped(
      RegExp(r'(\d{1,3})(?=(\d{3})+(?!\d))'),
      (Match m) => '${m[1]}.',
    );
    return 'Rp $result';
  }

  Widget _buildSectionHeader(String title) {
    return Padding(
      padding: const EdgeInsets.only(left: 8, bottom: 12),
      child: Text(
        title,
        style: GoogleFonts.poppins(
          fontSize: 18,
          fontWeight: FontWeight.bold,
          color: const Color(0xFF1E3A8A),
        ),
      ),
    );
  }

  Widget _buildInfoCard(List<Widget> children) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.04),
            blurRadius: 15,
            offset: const Offset(0, 5),
          ),
        ],
      ),
      padding: const EdgeInsets.all(20),
      child: Column(children: children),
    );
  }

  Widget _buildInfoRow(String label, String? value) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            flex: 2,
            child: Text(
              label,
              style: GoogleFonts.inter(
                fontSize: 14,
                color: Colors.grey.shade500,
                fontWeight: FontWeight.w500,
              ),
            ),
          ),
          const SizedBox(width: 12),
          Expanded(
            flex: 3,
            child: Text(
              value ?? '-',
              style: GoogleFonts.inter(
                fontSize: 14,
                color: const Color(0xFF1F2937),
                fontWeight: FontWeight.w600,
              ),
              textAlign: TextAlign.right,
            ),
          ),
        ],
      ),
    );
  }
}
