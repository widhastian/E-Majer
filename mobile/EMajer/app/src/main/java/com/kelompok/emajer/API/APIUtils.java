package com.kelompok.emajer.API;

public class APIUtils {

    private APIUtils(){

    }
//    public static final String API_URL = "http://192.168.43.56/emajer/api/";
    public static final String API_URL = "https://ws-tif.com/e-majer/api/";
    public static APIRequestPembayaranKas getReqBayarKas(){
        return com.kelompok.emajer.API.RetrofitClient.getClient(API_URL).create(APIRequestPembayaranKas.class);
    }

    public static APIRequestRiwayatTransaksi getReqRiwayatTransaksi(){
        return com.kelompok.emajer.API.RetrofitClient.getClient(API_URL).create(APIRequestRiwayatTransaksi.class);
    }

    public static APIRequestCatatanPengeluaran getReqCatatanPengeluaran(){
        return com.kelompok.emajer.API.RetrofitClient.getClient(API_URL).create(APIRequestCatatanPengeluaran.class);
    }

    public static APIRequestMading getReqMading(){
        return com.kelompok.emajer.API.RetrofitClient.getClient(API_URL).create(APIRequestMading.class);
    }

    public static ApiBarang getReqBarang() {
        return com.kelompok.emajer.API.RetrofitClient.getClient(API_URL).create(ApiBarang.class);
    }

    public static APIRequestOrders getReqOrders(){
        return com.kelompok.emajer.API.RetrofitClient.getClient(API_URL).create(APIRequestOrders.class);
    }
}
