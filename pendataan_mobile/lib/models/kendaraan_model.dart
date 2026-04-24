import 'dart:convert';

class KendaraanModel {
  final int? id;
  final String? nopol;
  final String? merk;
  final String? type;
  final String? model;
  final String? silinder;
  final String? warna;
  final String? pemilik;
  final String? jenisKendaraan;
  final String? rangka;
  final String? mesin;
  final int? tahun;
  final Map<String, dynamic>? insurance;
  final Map<String, dynamic>? stnk;
  final Map<String, dynamic>? kir;

  KendaraanModel({
    this.id,
    this.nopol,
    this.merk,
    this.type,
    this.model,
    this.silinder,
    this.warna,
    this.pemilik,
    this.jenisKendaraan,
    this.rangka,
    this.mesin,
    this.tahun,
    this.insurance,
    this.stnk,
    this.kir,
  });

  factory KendaraanModel.fromJson(Map<String, dynamic> json) {
    // Helper to handle both Map (from API) and JSON String (from SQLite)
    Map<String, dynamic>? parseNested(dynamic value) {
      if (value == null) return null;
      if (value is String) {
        try {
          return jsonDecode(value);
        } catch (e) {
          return null;
        }
      }
      return value as Map<String, dynamic>;
    }

    return KendaraanModel(
      id: json['id_kendaraan'],
      nopol: json['nopol'],
      merk: json['merk'],
      type: json['type'],
      model: json['model'],
      silinder: json['silinder'],
      warna: json['warna'],
      pemilik: json['pemilik'],
      jenisKendaraan: json['jenis_kendaraan'],
      rangka: json['rangka'],
      mesin: json['mesin'],
      tahun: json['tahun'],
      insurance: parseNested(json['insurance']),
      stnk: parseNested(json['stnk']),
      kir: parseNested(json['kir']),
    );
  }

  Map<String, dynamic> toMap() {
    return {
      'id_kendaraan': id,
      'nopol': nopol,
      'merk': merk,
      'type': type,
      'model': model,
      'silinder': silinder,
      'warna': warna,
      'pemilik': pemilik,
      'jenis_kendaraan': jenisKendaraan,
      'rangka': rangka,
      'mesin': mesin,
      'tahun': tahun,
      // Convert nested maps to JSON string for SQLite storage
      'insurance': insurance != null ? jsonEncode(insurance) : null,
      'stnk': stnk != null ? jsonEncode(stnk) : null,
      'kir': kir != null ? jsonEncode(kir) : null,
    };
  }
}
