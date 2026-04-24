import 'package:google_generative_ai/google_generative_ai.dart';
import '../models/kendaraan_model.dart';

class AiService {
  // TODO: Replace with your actual Gemini API Key
  static const String _apiKey = 'AIzaSyA6LQpLwbsv84FkPZ3WbhIgT81AWo24Wig';
  late final GenerativeModel _model;
  late ChatSession _chatSession;

  AiService() {
    _model = GenerativeModel(model: 'gemini-2.5-flash', apiKey: _apiKey);
  }

  void startChat(List<KendaraanModel> kendaraanList) {
    // Format the vehicle data to be used as context
    String contextData =
        "Berikut adalah data kendaraan yang kita miliki saat ini:\n";
    if (kendaraanList.isEmpty) {
      contextData += "Belum ada data kendaraan.";
    } else {
      for (var k in kendaraanList) {
        String platStnk =
            k.stnk != null ? (k.stnk!['plat'] ?? '-') : 'Tidak ada data';
        String pajakStnk =
            k.stnk != null ? (k.stnk!['pajak'] ?? '-') : 'Tidak ada data';
        String endAsuransi =
            k.insurance != null
                ? (k.insurance!['end_insurance'] ?? '-')
                : 'Tidak ada data';
        contextData +=
            "- Nopol (Kendaraan): ${k.nopol}, Plat (STNK): $platStnk, Pajak (STNK): $pajakStnk, Berakhir Pada: $endAsuransi, Merk: ${k.merk} ${k.model ?? 'Tidak ada Data'}, Pemilik: ${k.pemilik}, Warna: ${k.warna}\n";
      }
    }

    contextData +=
        "\nTugas Anda: Jawab pertanyaan pengguna mengenai data kendaraan di atas. Berikan jawaban yang ramah, ringkas, dan membantu. Jika pengguna bertanya tentang data yang tidak ada di daftar atas, beri tahu mereka bahwa Anda tidak memiliki informasi tersebut berdasarkan database saat ini.";

    // Initialize chat session with system instruction/context
    _chatSession = _model.startChat(
      history: [
        Content.text(contextData),
        Content.model([
          TextPart(
            'Baik, saya mengerti. Saya siap membantu menjawab pertanyaan mengenai data kendaraan tersebut.',
          ),
        ]),
      ],
    );
  }

  Future<String?> sendMessage(String message) async {
    try {
      final response = await _chatSession.sendMessage(Content.text(message));
      return response.text;
    } catch (e) {
      print('Error sending message to Gemini: $e');
      return 'Maaf, terjadi kesalahan saat menghubungi AI. Pastikan koneksi internet stabil dan API Key valid.';
    }
  }
}
