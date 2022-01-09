package com.pina.emajer_v2.API;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class APIUtils {

    private APIUtils(){

    }
//    public static final String API_URL = "http://192.168.43.56/emajer/api/";
    public static final String API_URL = "https://ws-tif.com/e-majer/api/";
    public static APIRequestPembayaranKas getReqBayarKas(){
        return com.pina.emajer_v2.API.RetrofitClient.getClient(API_URL).create(APIRequestPembayaranKas.class);
    }

    public static APIRequestRiwayatTransaksi getReqRiwayatTransaksi(){
        return com.pina.emajer_v2.API.RetrofitClient.getClient(API_URL).create(APIRequestRiwayatTransaksi.class);
    }

    public static APIRequestCatatanPengeluaran getReqCatatanPengeluaran(){
        return com.pina.emajer_v2.API.RetrofitClient.getClient(API_URL).create(APIRequestCatatanPengeluaran.class);
    }

    public static APIRequestMading getReqMading(){
        return com.pina.emajer_v2.API.RetrofitClient.getClient(API_URL).create(APIRequestMading.class);
    }

    public static ApiBarang getReqBarang() {
        return com.pina.emajer_v2.API.RetrofitClient.getClient(API_URL).create(ApiBarang.class);
    }

    public static APIRequestOrders getReqOrders(){
        return com.pina.emajer_v2.API.RetrofitClient.getClient(API_URL).create(APIRequestOrders.class);
    }
}
