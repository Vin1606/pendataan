import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/kendaraan_model.dart';
import 'db_helper.dart';

class ApiService {
  // Use 10.0.2.2 for Android Emulator, or your local IP for physical device
  // If running on Windows desktop, use 127.0.0.1
  static const String baseUrl = 'http://127.0.0.1:8000/api';
  final DbHelper _dbHelper = DbHelper();

  Future<List<KendaraanModel>> getKendaraan({String? keyword}) async {
    String url = '$baseUrl/kendaraan';
    if (keyword != null && keyword.isNotEmpty) {
      url += '?keyword=$keyword';
    }

    try {
      // 1. Attempt to fetch from API with 5 seconds timeout
      final response = await http
          .get(Uri.parse(url))
          .timeout(const Duration(seconds: 5));

      if (response.statusCode == 200) {
        final decodedData = json.decode(response.body);
        final List<dynamic> dataList = decodedData['data'];

        final listKendaraan =
            dataList.map((item) => KendaraanModel.fromJson(item)).toList();

        // 2. Cache data to SQLite
        // We only overwrite the local cache if we are fetching all data (not searching via API)
        if (keyword == null || keyword.isEmpty) {
          await _dbHelper.insertKendaraanList(listKendaraan);
        }

        return listKendaraan;
      } else {
        throw Exception('API return status ${response.statusCode}');
      }
    } catch (e) {
      print('API fetch failed: $e. Falling back to local SQLite.');
      // 3. Fallback to SQLite if API fails (offline or timeout)
      try {
        final localData = await _dbHelper.getAllKendaraan(keyword: keyword);
        if (localData.isNotEmpty) {
          return localData;
        } else {
          throw Exception('Server offline dan belum ada data lokal.');
        }
      } catch (dbError) {
        throw Exception('Gagal memuat data dari server maupun lokal: $dbError');
      }
    }
  }
}
