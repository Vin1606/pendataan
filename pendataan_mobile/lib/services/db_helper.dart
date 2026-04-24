import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';
import '../models/kendaraan_model.dart';

class DbHelper {
  static final DbHelper _instance = DbHelper._internal();
  factory DbHelper() => _instance;
  DbHelper._internal();

  static Database? _database;

  Future<Database> get database async {
    if (_database != null) return _database!;
    _database = await _initDb();
    return _database!;
  }

  Future<Database> _initDb() async {
    String path = join(await getDatabasesPath(), 'kendaraan_db.db');
    return await openDatabase(
      path,
      version: 1,
      onCreate: _onCreate,
    );
  }

  Future<void> _onCreate(Database db, int version) async {
    await db.execute('''
      CREATE TABLE kendaraan (
        id_kendaraan INTEGER PRIMARY KEY,
        nopol TEXT,
        merk TEXT,
        type TEXT,
        model TEXT,
        silinder TEXT,
        warna TEXT,
        pemilik TEXT,
        jenis_kendaraan TEXT,
        rangka TEXT,
        mesin TEXT,
        tahun INTEGER,
        insurance TEXT,
        stnk TEXT,
        kir TEXT
      )
    ''');
  }

  // Save new data from API (replacing old cache)
  Future<void> insertKendaraanList(List<KendaraanModel> kendaraanList) async {
    final db = await database;
    await db.transaction((txn) async {
      await txn.delete('kendaraan'); // Clear old data
      for (var kendaraan in kendaraanList) {
        await txn.insert(
          'kendaraan',
          kendaraan.toMap(),
          conflictAlgorithm: ConflictAlgorithm.replace,
        );
      }
    });
  }

  // Fetch data locally, with optional search
  Future<List<KendaraanModel>> getAllKendaraan({String? keyword}) async {
    final db = await database;
    List<Map<String, dynamic>> maps;

    if (keyword != null && keyword.isNotEmpty) {
      maps = await db.query(
        'kendaraan',
        where: 'nopol LIKE ? OR merk LIKE ? OR pemilik LIKE ?',
        whereArgs: ['%$keyword%', '%$keyword%', '%$keyword%'],
      );
    } else {
      maps = await db.query('kendaraan');
    }

    return List.generate(maps.length, (i) {
      return KendaraanModel.fromJson(maps[i]);
    });
  }
}
